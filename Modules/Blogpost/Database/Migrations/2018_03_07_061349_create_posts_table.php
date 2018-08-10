<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');	
			$table->string('taxonomy')->unsigned()->default("post");	
			$table->string('slug');	
            $table->string('lang');	  
            $table->text('description'); 
            $table->integer('user_id');	
            $table->timestamps();
           
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->default("0");
            $table->integer('parent_id')->unsigned()->default("0");
			$table->string('title');	
			$table->string('slug');	
			$table->string('lang');	
			$table->string('shop');	
			$table->integer('user_id');	
			$table->string('post_type');	
            $table->text('description');	
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('metafields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');	
			$table->string('handle');	
			$table->string('lang');	
			$table->integer('user_id');	
            $table->string('type');
            $table->string('post_type');		
            $table->text('description');	
            $table->timestamps();
        });

        Schema::create('metavalues', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');	
			$table->string('handle');	
			$table->string('value');	
            $table->integer('post_id')->unsigned();	
            $table->integer('meta_id')->unsigned();
            $table->integer('user_id');	
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('meta_id')->references('id')->on('metafields');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        #Schema::dropForeign('posts_post_id_foreign');
    }
}
