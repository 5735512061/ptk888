<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class DeleteProductCartSessionStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeleteProductCartSessionStore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete database product_cart_session_stores when after 4 hr';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $product_cart_session_stores = DB::table('product_cart_session_stores')->get();
        $product_cart_session_store_film_brands = DB::table('product_cart_session_store_film_brands')->get();
        
        foreach($product_cart_session_stores as $product_cart_session_store => $value) {
            $product_cart_session_store = DB::table('product_cart_session_stores')->where('id',$value->id)->delete();
        }

        foreach($product_cart_session_store_film_brands as $product_cart_session_store_film_brand => $value) {
            $product_cart_session_store_film_brand = DB::table('product_cart_session_store_film_brands')->where('id',$value->id)->delete();
        }
    }
}
