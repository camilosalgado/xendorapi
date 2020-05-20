<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    Route::get('/report1getdata/{fecini}/fin/{fecfin}', function($fechini, $fechfin) {
    	$sourceOne = new \DateTime($fechini);
        $formatDateOne = $sourceOne->format('d/m/yy');
        $sourceTwo = new \DateTime($fechfin);
        $formatDateTwo = $sourceTwo->format('d/m/yy');

        return response()->json(DB::select("SELECT * FROM REPORT_NOMINA('$formatDateOne','$formatDateTwo')"));
    });

	Route::get('/report2getdata/{fec}', function($fecha) {
		$date = new \DateTime($fecha);
        $formatdate = $date->format('d/m/yy');
        return response()->json(DB::select("SELECT * FROM dbo.conce_duplicado('$formatdate')"));
	});

	Route::get('/report3getdata/{mes}', function($mes) {
		return response()->json(DB::select("select * from PROG_CUMPLE('$mes')"));
	});

    Route::get('/report4getdata/{fecini}/fin/{fecfin}', function($fechini, $fechfin) {
    	$sourceOne = new \DateTime($fechini);
        $formatDateOne = $sourceOne->format('d/m/yy');
        $sourceTwo = new \DateTime($fechfin);
        $formatDateTwo = $sourceTwo->format('d/m/yy');

        return response()->json(DB::select("SELECT * FROM SOLI_PERMI_APROBADOS('$formatDateOne','$formatDateTwo')"));
    }); 
	    
});