<?php
namespace websdk\kysdk;
use websdk\func\Curl;

class Clientauth
{
    const server_url = "http://192.168.2.13:8100/web/ca";
    const appId = "16001";

    //商户认证登录
    //
    //请求url: /ca/merchant_login
    //请is式: POST
    //请求参数: appId=16001&userName=&password=&curTs=
    //请求参数说明: 应用id=16001&用户名=&密码=&时间戳=
    //说明：例子 http://192.168.2.13:8100/web/ca/merchant_login?appId=10021&userName=17688190013&password=123456a&curTs=1495184702
    //响应结果:resUserId授权用户登录id,sid会话id,nickname昵称,headImage头像,userId幸福号
    public static function merchant_login($username,$password){
        $url = self::server_url.'/merchant_login';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'userName'=>$username,'password'=>$password,'curTs'=>$curTs));

    }

    //校验登录状态
    //
    //请求url: /ca/check_login
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=
    //说明：
    //响应结果:
    public static function check_login($resUserId,$sid){
        $url = self::server_url.'/check_login';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs));
    }

    //获取商户认证信息
    //
    //请求url: /ca/get_merchant
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=
    //说明：
    //响应结果:CaMerchantInfo[bankAccount银行账号;
    //bankArea开户行省市;
    //bankName开户行详细名称;
    //bankType开户行类别;
    //businessBegin营业执照有效期开始时间;businessEnd营业执照有效期结束时间;
    //businessImage营业执照照片;
    //businessLong营业执照是否长期：0不长期1长期;
    //businessNo营业执照号码;
    //businessScope经营范围;
    //businessSite营业执照登记的地址;
    //caNo商户认证id;
    //caStatus商户认证状态：-1审核不通过0已提交待审核1审核通过;
    //caTime提交时间;
    //merImage商户图标;
    //merName商户名称;
    //merNickname商户昵称;
    //merPhone商户电话;
    //merRealImage商户实景照片;
    //ownerId经营者身份证;
    //ownerIdImageFront经营者身份证手持正面;
    //ownerIdImageVerso经营者身份证手持反面;
    //ownerName经营者名称;
    //receiverAddress收件人详细地址;
    //receiverArea收件人地址区域;
    //receiverMobile收件人手机号码;
    //receiverName收件人名称;
    //receiverPhone收件人固定电话;
    //taxeBegin税务登记证有效期开始时间;
    //taxeEnd税务登记证有效期结束时间;
    //taxeImage税务登记证照片;
    //taxeLong税务登记证是否长期：0不长期1长期;
    //taxeNo税务登记号;
    //userId用户幸福号;
    //memberAccount用户会员中心账号;]
    public static function get_merchant($resUserId,$sid){
        $url = self::server_url.'/get_merchant';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs));
    }

    //提交商户认证信息
    //
    //请求url: /ca/save_merchant
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&data=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&认证资料=
    //说明：data为CaMerchantInfo的JSON格式
    //响应结果:CaMerchantInfo
    public static function save_merchant($resUserId,$sid,$data){
        $url = self::server_url.'/save_merchant';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'data'=>$data));
    }

    //图片文件上传
    //
    //请求url: /ca/image_upload
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=
    //说明：
    //响应结果:imageName
    public static function image_upload($resUserId,$sid,$ext,$data){
        $url = self::server_url.'/image_upload';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'ext'=>$ext,'data'=>$data,'curTs'=>$curTs));
    }

    //检验商户昵称唯一性
    //
    //请求url: /ca/check_mer_nickname
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&merNickname=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&商户昵称=
    //说明：
    //响应结果:TRUE/FALSE
    public static function check_mer_nickname($resUserId,$sid,$merNickname){
        $url = self::server_url.'/check_mer_nickname';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'merNickname'=>$merNickname));
    }

    //获取审核信息
    //
    //请求url: /ca/get_audit_info
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=
    //说明：
    //响应结果:CaAuditInfo[auditTime审核时间；auditStatus审核状态；note原因]
    public static function get_audit_info($resUserId,$sid){
        $url = self::server_url.'/get_audit_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs));
    }

    //修改银行卡信息
    //
    //请求url: /ca/save_bank_info
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&data=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&银行卡信息=
    //说明：data为[bankAccount银行账号;bankArea开户行省市;bankName开户行详细名称;bankType开户行类别;]的JSON格式
    //响应结果:
    public static function save_bank_info($resUserId,$sid,$data){
        $url = self::server_url.'/save_bank_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'data'=>$data));
    }

    //修改商户昵称
    //
    //请求url: /ca/save_nickname_info
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&merNickname=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&商户昵称称=
    //说明：
    //响应结果:
    public static function save_nickname_info($resUserId,$sid,$merNickname){
        $url = self::server_url.'/save_nickname_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'merNickname'=>$merNickname));
    }


    //修改商户图标
    //
    //请求url: /ca/save_mer_image_info
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&merImage=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&商户图片名称=
    //说明：
    //响应结果:
    public static function save_mer_image_info($resUserId,$sid,$merImage){
        $url = self::server_url.'/save_mer_image_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'merImage'=>$merImage));
    }

    //修改收件人信息
    //
    //请求url: /ca/save_receive_info
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&data=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&银行卡信息=
    //说明：data为[receiverAddress收件人详细地址;receiverArea收件人地址区域;receiverMobile收件人手机号码;receiverName收件人名称;receiverPhone收件人固定电话;]的JSON格式
    //响应结果:
    public static function save_receive_info($resUserId,$sid,$data){
        $url = self::server_url.'/save_receive_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'data'=>$data));
    }

    //校验登录密码
    //
    //请求url: /ca/check_password
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&password=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&登录密码=
    //说明：
    //响应结果:
    public static function check_password($resUserId,$sid,$password){
        $url = self::server_url.'/check_password';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'password'=>$password));
    }

    //校验登录密码
    //
    //请求url: /ca/check_password
    //请is式: POST
    //请求参数: appId=16001&resUserId=&sid=&curTs=&password=
    //请求参数说明: 应用id=16001&授权用户登录id=&会话id=&时间戳=&登录密码=
    //说明：
    //响应结果:
    public static function save_ca_info($resUserId,$sid,$data){
        $url = self::server_url.'/save_ca_info';
        $curTs = time();
        return Curl::post($url,array('appId'=>self::appId,'resUserId'=>$resUserId,'sid'=>$sid,'curTs'=>$curTs,'data'=>$data));
    }

}