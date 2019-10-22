<?php
use Illuminate\Support\Facades\DB;
function zz($model)
{
    if (method_exists($model, 'toArray')) {
        dd($model->toArray());
    } else {
        dd($model);
    }
}

function msg($msg){
    print_r($msg);exit;
}
/**
 * @return mixed
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 给浏览器静态资源加版本号,强制刷新缓存
 * @param  string $source 资源路径
 * @return string         资源路径加上版本号
 */
function edition($source)
{   
    $local_version = "local_".rand(100000000000,999999999999);
    $server_version = 1;
    return $source . '?v='.$local_version;
}


/**
 * [unique_arr 去除二维数组重复值]
 * @return [type] [返回值是二维数组]
 */
function unique_arr($array2D,$stkeep=false,$ndformat=true){

    // 判断是否保留一级数组键 (一级数组键可以为非数字)
    if($stkeep) $stArr = array_keys($array2D);	//返回数据的下标

    // 判断是否保留二级数组键 (所有二级数组键必须相同)
    if($ndformat) $ndArr = array_keys(end($array2D));	//返回二维数组的最后一个下标

    //降维,也可以用implode,将一维数组转换为用逗号连接的字符串,结果是索引一维数组
    foreach ($array2D as &$v){
        if(isset($v['pivot']))
        {
            unset($v['pivot']);
        }
        $v = implode(",",$v);
        $temp[] = $v;
    }

    //去掉重复的字符串,也就是重复的一维数组
    $temp = array_unique($temp);

    //再将拆开的数组重新组装
    foreach ($temp as $k => $v)
    {
        if($stkeep) $k = $stArr[$k];
        if($ndformat)
        {
            $tempArr = explode(",",$v);
            foreach($tempArr as $ndkey => $ndval) $output[$k][$ndArr[$ndkey]] = $ndval;
        }
        else $output[$k] = explode(",",$v);
    }

    return $output;
}


// 阿拉伯数字转中文大写金额
function num_to_rmb($num) {
    $c1 = "零壹贰叁肆伍陆柒捌玖";
    $c2 = "分角元拾佰仟万拾佰仟亿";
    //精确到分后面就不要了，所以只留两个小数位
    $num = round($num, 2);
    //将数字转化为整数
    $num = $num * 100;
    if (strlen($num) > 10) {
        return "金额太大，请检查";
    }
    $i = 0;
    $c = "";
    while (1) {
        if ($i == 0) {
        //获取最后一位数字
            $n = substr($num, strlen($num) - 1, 1);
        } else {
            $n = $num % 10;
        }
        //每次将最后一位数字转化为中文
        $p1 = substr($c1, 3 * $n, 3);
        $p2 = substr($c2, 3 * $i, 3);
        if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
            $c = $p1 . $p2 . $c;
        } else {
            $c = $p1 . $c;
        }
        $i = $i + 1;
        //去掉数字最后一位了
        $num = $num / 10;
        $num = (int) $num;
        //结束循环
        if ($num == 0) {
            break;
        }
    }
    $j = 0;
    $slen = strlen($c);
    while ($j < $slen) {
        //utf8一个汉字相当3个字符
        $m = substr($c, $j, 6);
        //处理数字中很多0的情况,每次循环去掉一个汉字“零”
        if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
            $left = substr($c, 0, $j);
            $right = substr($c, $j + 3);
            $c = $left . $right;
            $j = $j - 3;
            $slen = $slen - 3;
        }
        $j = $j + 3;
    }
    //这个是为了去掉类似23.0中最后一个“零”字
    if (substr($c, strlen($c) - 3, 3) == '零') {
        $c = substr($c, 0, strlen($c) - 3);
    }
    //将处理的汉字加上“整”
    if (empty($c)) {
        return "零元整";
    } else {
        return $c . "整";
    }
}



function in_authority($authority)
{   
    //Session::flush();
    //msg(session()->has('in_authority'));
    $user = Auth::guard('admin')->user();
    if($user->id == 1){
        return 1;
    }
    if(session()->has('in_authority')){
        $route = json_decode(session('in_authority'),true);
    }else{
        
        $role_id = \DB::table('admin_role')->where('admin_id',$user->id)->value('role_id');
        $route = \DB::table('role_auth')->where('role_id',$role_id)->join('rules','rules.id','role_auth.rule_id')->select('route')->get()->toArray();
        $res = json_encode($route);
        session(['in_authority' => $res]);
        $route = json_decode(session('in_authority'),true);      
    }

    $routes = [];
    foreach ($route as $key => $value) {
        $routes[] = $value['route'];
    }

    //银行转账，代收明细，直接发放，挂失管理

    if(in_array($authority,$routes))
    {
        return 1;
    }else{
        return 0;
    }
}


function viewError($message = null, $url = null, $type = 'error' ,$view = null, $wait = 3)
{

    $view = 'commons.'.$type;

    return response()->view($view,[
        'url'=> $url ? route($url) : '/',
        'message'=>$message[0] ? $message[0] : '发生错误,请重试!',
        'other_msg' => $message[1],
        'wait' => $wait,
    ]);
    
}