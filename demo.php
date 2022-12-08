<?php
$init_url = "https://api.openai.com/v1/completions";
$YOUR_KEY="你的key"; // 你的OpenAI的key (https://beta.openai.com/account/api-keys)
$WORD="你好世界";
if (!is_null($_GET['word'])){
    $WORD = $_GET['word'];
}
$init_data=array(
    "model" =>"text-davinci-003", //模型
    "prompt" =>$WORD,   
    "temperature" => 0.5, //温度
    "max_tokens" => 4000,
    "top_p" => 1.0,
    "frequency_penalty" =>0.8,
    "presence_penalty" =>0.0
    );
// 数据输出
exit (posturl($init_url,$init_data)['choices'][0]['text']);



// libcurl.php的代码片段
function posturl($url, $data)
{
    global $YOUR_KEY;
    $data = json_encode($data);
    $headerArray = array(
        "Content-type: application/json;charset='utf-8'", 
        "Accept:application/json", 
        "Authorization:Bearer ".$YOUR_KEY,  
        );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return json_decode($output, true);
}