<?php

use App\Http\Controllers\OperationsCabinetController;
use App\Operations_Cabinet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations__cabinets', function (Blueprint $table) {
            $table->id();
            $table->string('Intitule', 120); 
            $table->decimal('Prix');
            $table->longText('Description')->nullable();
            });

            Operations_Cabinet::create([
            'Intitule'  =>  'Radio',
            'Prix'  =>  400,
            'Description'  =>  null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations__cabinets');
    }
}