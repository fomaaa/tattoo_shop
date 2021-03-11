<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property int $page_id
 * @property string $page_type
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $twitter_card
 * @property string $twitter_site
 * @property string $twitter_title
 * @property string $twitter_description
 * @property string $twitter_creator
 * @property string $twitter_image
 * @property string $og_title
 * @property string $og_type
 * @property string $og_url
 * @property string $og_image
 * @property string $og_description
 * @property string $og_site_name
 * @property string $fb_admins
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'page_type'], 'required'],
            [['page_id'], 'integer'],
            [['twitter_card', 'twitter_site', 'twitter_title', 'twitter_description', 'twitter_creator', 'twitter_image', 'og_title', 'og_type', 'og_url', 'og_image', 'og_description', 'og_site_name', 'fb_admins'], 'string'],
            [['page_type', 'title', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'page_type' => 'Page Type',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'twitter_card' => 'Twitter Card',
            'twitter_site' => 'Twitter Site',
            'twitter_title' => 'Twitter Title',
            'twitter_description' => 'Twitter Description',
            'twitter_creator' => 'Twitter Creator',
            'twitter_image' => 'Twitter Image',
            'og_title' => 'Og Title',
            'og_type' => 'Og Type',
            'og_url' => 'Og Url',
            'og_image' => 'Og Image',
            'og_description' => 'Og Description',
            'og_site_name' => 'Og Site Name',
            'fb_admins' => 'Fb Admins',
        ];
    }
}
