<?php

App::uses('AppModel','Model');
 class Item extends AppModel
 {
    public $actsAs = [
        // UploadプラグインのUploadBehaviorという意味
        'Upload.Upload' => [
            // photoというカラムに Uploadビヘイビアを使ってファイル名を登録する
            'photo' => [
                // デフォルトのカラム名 dir を photo_dir に変更
                'fields' => ['dir' => 'photo_dir'],
                'deleteOnUpdate' => false,
            ]
        ]
    ];


    public $validate = array(
      'name'=>array(
        'rule1' => array(
            'rule'=>array('notBlank'),
            'message' => '商品名を入力して下さい',
            ),
        'rule2' => array(
            'rule' => array('maxLength',20),
            'message' => '商品名は20文字以下にしてください'
            )
        ),
      //登録用
      'cha_rec_num'=>array(
        'rule1' => array(
            'rule'=>array('notBlank'),
            'message' => '商品番号を入力して下さい',
            ),
        'rule2' => array(
            'rule'=>array('myIsUnique'),
            'message' => '既に登録されている番号です',
            ),
        ),
      //編集用
      'cha_rec_id'=>array(
        'rule1' => array(
            'rule'=>array('notBlank'),
            'message' => '商品番号を入力して下さい',
            ),
        'rule2' => array(
            'rule'=>array('isUnique'),
            'message' => '既に登録されている番号です',
            ),
        ),
      'amount' => array(
        'rule1' => array(
            'rule' => array('notBlank'),
            'message' => '金額を入力して下さい',
            ),
        'rule2' => array(
            'rule' => array('numeric'),
            'message' => '数値を入力してください'
            )
        ),
      'description' => array(
        'rule' => array('notBlank'),
        'message' => '内容を入力して下さい',
        ),
      'photo' => [
        'UnderPhpSizeLimit' => [
            'allowEmpty' => true,
            'rule' => 'isUnderPhpSizeLimit',
            'message' => 'アップロード可能なファイルサイズを超えています'
        ],
        'BelowMaxSize' => [
            'rule' => ['isBelowMaxSize',5242880],
            'message' => 'アップロード可能なファイルサイズを超えています'
        ],
        'CompleteUpload' => [
            'rule' => 'isCompletedUpload',
            'message' => 'ファイルが正常にアップロードされませんでした'
        ],
        'ValidMimeType' => [
            'rule' => ['isValidMimeType',['image/jpeg','image/png'],false],
            'message' => 'ファイルの拡張子がJPEGでもPNGでもありません'
        ],
        'ValidExtension' => [
            'rule' => ['isValidExtension',['jpeg','jpg','png'],false],
            'message' => 'ファイルの拡張子がJPEGでもPNGでもありません'
        ]
      ]
    );


    public function myIsUnique($check){

        $params = array(
            'conditions' => array(
                'Item.cha_rec_id' => $check['cha_rec_num'],
            )
        );

        $results = $this->find('count', $params);

        if($results){
            return false;
        }else{
            return true;
        }
    }

}