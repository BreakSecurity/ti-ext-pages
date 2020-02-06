<?php namespace Igniter\Pages\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Schema;

class CreatePagesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('pages'))
            return;

        Schema::create('pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('page_id', TRUE);
            $table->integer('language_id');
            $table->string('name');
            $table->string('title');
            $table->string('permalink_slug');
            $table->string('heading')->nullable();
            $table->text('content');
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('layout_id')->nullable();
            $table->text('navigation')->nullable();
            $table->dateTime('date_added');
            $table->dateTime('date_updated');
            $table->boolean('status');
        });

        $this->seedPages();
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }

    protected function seedPages()
    {
        if (DB::table('pages')->count())
            return;

        $language = DB::table('languages')->where('code', 'en')->first();

        DB::table('pages')->insert([
            [
                'language_id' => $language->language_id,
                'name' => 'About Us',
                'title' => 'About Us',
                'heading' => 'About Us',
                'permalink_slug' => 'about-us',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'meta_description' => '',
                'meta_keywords' => '',
                'navigation' => 'a:2:{i:0;s:8:\'side_bar\';i:1;s:6:\'footer\';}',
                'date_added' => '2014-04-19 16:57:21',
                'date_updated' => '2015-05-07 12:39:52',
                'status' => 1,
            ],
            [
                'language_id' => $language->language_id,
                'name' => 'Policy',
                'title' => 'Policy',
                'heading' => 'Policy',
                'permalink_slug' => 'policy',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'meta_description' => '',
                'meta_keywords' => '',
                'navigation' => 'a:2:{i:0;s:8:\'side_bar\';i:1;s:6:\'footer\';}',
                'date_added' => '2014-04-19 17:21:23',
                'date_updated' => '2015-05-16 09:18:39',
                'status' => 1,
            ],
            [
                'language_id' => $language->language_id,
                'name' => 'Terms and Conditions',
                'title' => 'Terms and Conditions',
                'heading' => 'Terms and Conditions',
                'permalink_slug' => 'terms-and-conditions',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'meta_description' => '',
                'meta_keywords' => '',
                'navigation' => 'a:2:{i:0;s:8:\'side_bar\';i:1;s:6:\'footer\';}',
                'date_added' => '2014-04-19 17:21:23',
                'date_updated' => '2015-05-16 09:18:39',
                'status' => 1,
            ],
        ]);
    }
}