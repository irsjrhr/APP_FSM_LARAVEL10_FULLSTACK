<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class S3_client {

    protected $client;
    protected $bucket;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->config->load('s3');
        $config = $CI->config->item('s3');

        $this->bucket = $config['bucket'];

        $this->client = new S3Client([
            'version'     => $config['version'],
            'region'      => $config['region'],
            'endpoint'    => $config['endpoint'],
            'credentials' => $config['credentials'],
            'use_path_style_endpoint' => true,
            'http' => [
                'verify' => false // <<< tambahkan ini
            ]
        ]);
    }

    public function upload($filePath, $keyName, $acl = 'public-read')
    {
        $response = [
            'status' => null,
            'msg' => "none"
        ];
        try {
            $result = $this->client->putObject([
                'Bucket'     => $this->bucket,
                'Key'        => $keyName,
                'SourceFile' => $filePath,
                'ACL'        => $acl
            ]);
            $response['status'] = true;
            $response['msg'] = "Berhasil melakukan upload file ke cloud!!";
            $response['url'] = $result['ObjectURL'];

            return $response;
        } catch (AwsException $e) {
            $response['status'] = false;
            $response['msg'] =  $e->getMessage();
            
            return $response;
        }
    }

    public function delete($keyName)
    {
        try {
            $this->client->deleteObject([
                'Bucket' => $this->bucket,
                'Key'    => $keyName
            ]);
            return true;
        } catch (AwsException $e) {
            return $e->getMessage();
        }
    }
}
