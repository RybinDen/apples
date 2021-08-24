<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property string $date_create
 * @property string|null $date_down
 * @property int $status
 * @property int $condition
 * @property int $size
 */
class Apple extends \yii\db\ActiveRecord
{
    const STATUS_DOWN = 0; // упало
    const STATUS_TREE = 1; // на дереве
    protected $colors = ['Red', 'yellow', 'green', 'aspic', 'speckled', 'shiny', 'blush'];
    const STATUS_ROTTEN = 2; // гнилое
    public static function tableName()
    {
        return '{{%apple}}';
    }

/*    public function rules()
    {
        return [
            [['color', 'date_create'], 'required'],
            [['date_create', 'date_down'], 'safe'],
            [['status', 'condition'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_TREE],
            ['status', 'in', 'range' => [self::STATUS_TREE, self::STATUS_DOWN]],
            [['color'], 'string', 'max' => 255],
        ];
    }
*/
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'date_create' => 'Дата появления',
            'date_down' => 'Дата падения',
            'status' => 'Статус',
            'condition' => 'Состояние',
            'size' => 'Съедено % ',
        ];
    }
    public function getListStatusName(){
        return [
            self::STATUS_TREE => 'На дереве',
            self::STATUS_DOWN => 'На земле',
            self::STATUS_ROTTEN => 'Гнилое',
        ];
    }
    public function getStatusName(){
        if($this->status == self::STATUS_TREE){
            return 'На дереве';
        }elseif($this->status == self::STATUS_DOWN){
            return 'На земле';
        }elseif($this->status == self::STATUS_ROTTEN){
            return 'Гнилое';
        }else{
            return 'Неопределенный';
        }
    }
    public function getConditionName(){
        if($this->condition == self::STATUS_TREE){
            return 'На дереве';
        }elseif($this->condition == self::STATUS_DOWN){
            return 'На земле';
        }elseif($this->condition == self::STATUS_ROTTEN){
            return 'Гнилое';
        }else{
            return 'Неопределенный';
        }
    }
    public function insertData(){
        $color = array_rand($this->colors);
        $this->color = $this->colors[$color];
        $date = date_create();
        $this->date_create = date_timestamp_get($date);
        $this->size = 0;
        $this->status = 1;
        $this->condition = 1;
    }
    public function fallToGround(){ //  упасть
        $this->status = self::STATUS_DOWN;
        $this->save();
    }
    public function eat($percent){ // съесть ($percent - процент откушенной части)
        //пока висит на дереве съесть нельзя
        if($this->status == 0){
            $this->size = $percent /100;
            $this->save();
            return true;
        }else{
            return false;
        }
    }
    /*public function delete(){ // удалить (когда полностью съедено)
    */
}
