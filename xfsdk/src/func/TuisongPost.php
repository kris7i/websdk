<?php
namespace xfsdk\func;

/*
     模拟资源推送类
     2012-09-14 by POOY
*/
class TuisongPost{

    //用构造登陆认证
    function TuisongPost(){

        //存放COOKIE的文件
        global $cookie_jar;
        $this->cookie_jar = tempnam('./tmp','cookie');
        $url = "http://www.pooy.net";

        $post_data = array( "username" => "admin","password" => "admin" );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_HEADER, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_jar);  //保存cookie信息

        $output1 = curl_exec($ch);

        curl_close($ch);

        //echo $this->cookie_jar."\n";
    }
    /*得到组ID*/
    function getGid($groupname,$channel,$lanmu){

        $url = "http://XXXX.com/creategroup";

        //格式化要推送的数据
        $data = $this->getGidArr($groupname,$channel,$lanmu);

        $ch = curl_init();

        $Ref_url = "http://www.pooy.net";

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_REFERER, $Ref_url);       //伪装REFERER

        curl_setopt($ch, CURLOPT_POST, 1);   //post方式提交数据

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //返回数据，而不是直接输出

        curl_setopt($ch, CURLOPT_HEADER, 0);   // 设置是否显示header信息 0是不显示，1是显示  默认为0

        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_jar);  //发送cookie文件

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);   //发送POST数据

        $output2 = curl_exec($ch);    //发送HTTP请求

        //这个返回值是用作判断的依据
        return $output2;
        curl_close($ch);
        //$this->unlink($this->cookie_jar);
    }

    //推送数据
    function sendPic($note,$groupid,$groupindex,$img){

        $url = "http://XXXX/addimage";

        $groupid = intval($groupid);
        $data = $this->sendPicArr($note,$groupid,$groupindex,$img);

        $ch = curl_init();

        $Ref_url = "http://www.pooy.net";

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_REFERER, $Ref_url);       //伪装REFERER

        curl_setopt($ch, CURLOPT_POST, 1);   //post方式提交数据

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //返回数据，而不是直接输出

        curl_setopt($ch, CURLOPT_HEADER, 0);   // 设置是否显示header信息 0是不显示，1是显示  默认为0

        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_jar);  //发送cookie文件

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);   //发送POST数据

        $output2 = curl_exec($ch);    //发送HTTP请求
        return $output2 ;
        curl_close($ch);
        //$this->unlink($this->cookie_jar);
    }

    /*推送数据操作*/
    function sendMes($url,$img,$imgdesc,$groupid,$groupname,$channel,$lanmu)
    {
        //var_dump($this->cookie_jar);
        //exit();
        $url = "http://XXXX/add";

        $data = $this->getArr($img,$imgdesc,$groupid,$groupname,$channel,$lanmu);

        $ch = curl_init();

        $Ref_url = "http://www.pooy.net";

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_REFERER, $Ref_url);       //伪装REFERER

        curl_setopt($ch, CURLOPT_POST, 1);   //post方式提交数据

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //返回数据，而不是直接输出

        curl_setopt($ch, CURLOPT_HEADER, 0);   // 设置是否显示header信息 0是不显示，1是显示  默认为0

        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_jar);  //发送cookie文件

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);   //发送POST数据

        $output2 = curl_exec($ch);    //发送HTTP请求

        curl_close($ch);
        //$this->unlink($this->cookie_jar);
    }

    function getArr($img,$imgdesc,$groupid,$groupname,$channel,$lanmu)
    {
        $post_data = array(
            //windows使用如下写法，linux不适用
            //"img"=>"@".$img.";type=image/jpeg",
            "img"=>"@".$img,
            "imgdesc"=>$imgdesc,
            "groupid"=>$groupid,
            "groupname"=>$groupname,
            "channel"=>$channel,
            "lanmu"=>$lanmu,
            "cdate"=>date('Y-m-d')
        );
        return $post_data;
    }
    //格式化getGidArr
    function getGidArr($groupname,$channel,$lanmu)
    {
        $post_data = array(
            "groupname"=>$groupname,
            "channel"=>$channel,
            "lanmu"=>$lanmu,
            "cdate"=>date('Y-m-d')
        );
        return $post_data;
    }
    //格式化sendPicArr
    function sendPicArr($note,$groupid,$groupindex,$img)
    {
        $post_data = array(
            "notes"=>$note,
            "id"=>$groupid,
            "index"=>$groupindex,
            "cdate"=>date('Y-m-d'),
            //windows使用如下写法，linux不适用
            //"img"=>"@".$img.";type=image/jpeg",
            "img"=>"@".$img
        );
        return $post_data;
    }

    //清理cookie文件
    function unlink($cookie_jar){
        unlink($cookie_jar);
    }
}