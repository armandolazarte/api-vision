<?php

use Illuminate\Http\Request;
//require "../vendor/autoload.php";
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


Route::post('oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
//Auth::routes(['register' => false]);


/************************USUARIOS************************** */


Route::name('user-info')->get('user/password', 'User\UserController@getPassword');
Route::name('user-info')->get('user/info/menu', 'User\UserController@getUserDataAndMenu');
Route::name('user-info')->get('user/menu', 'User\UserController@getMenu');
Route::name('user-info')->post('user/menu/add/{id}', 'User\UserController@agregarMenuUsuario');
Route::name('user-info')->delete('user/menu/{id}', 'User\UserController@borrarMenuUsuario');
Route::name('user-info')->get('user/listado', 'User\UserController@getUsuarios');
Route::name('user-info')->post('user/crear', 'User\UserController@CrearUsuario');
Route::name('user-info')->put('user/editar/{id}', 'User\UserController@EditarUsuario');
Route::name('user-info')->put('user/editar/password/{id}', 'User\UserController@EditarUsuarioPassword');
Route::resource('user', 'User\UserController');
Route::resource('medico', 'Medico\MedicoController');
/********************* */

Route::name('medico-afip')->get('medico/factura/afip', 'Medico\MedicoController@getAfip');

Route::resource('medicoobrasocial', 'Medico\MedicoObraSocialController');
Route::name('medico-obrasocial')->post('medicoobrasocial', 'Medico\MedicoController@postMedicoObraSocial');
Route::name('medico-obrasocial')->get('medico/obrasocial/todos', 'Medico\MedicoObraSocialController@byIdMedicoTodos');
Route::name('medico-obrasocial')->get('medico/obrasocial/byobrasocial', 'Medico\MedicoObraSocialController@getMedicoByObraSocialHabilitado');
Route::name('medico-obrasocia')->get('medico/obrasocial/bymedico', 'Medico\MedicoObraSocialController@getObraSocialByMedicoHabilitado');
Route::name('medico-obrasocia')->get('medico/obrasocial/bymedico/todos', 'Medico\MedicoObraSocialController@getObraSocialByMedicoTodos');
Route::name('filter-medico-obra-social')->get('medicoobrasocial/bymedico/{id}', 'Medico\MedicoObraSocialController@byIdMedico');
Route::name('filter-medico-obra-social-hablitado')->get('medicoobrasocial/bymedicohabilitado/{id}', 'Medico\MedicoObraSocialController@byIdMedicoHabilitado');
Route::resource('estudio', 'Estudio\EstudioController');



/**AGENDA **/
Route::resource('agenda', 'Agenda\AgendaController');


Route::name('agenda-gestion')->get('agenda/horarios/turno/medico/sobreturno', 'Agenda\AgendaController@getAgendaAtByFechaUsuarioSobreTurno');
//Route::name('agenda-gestion')->get('agenda/horarios/turno/medico/sobreturno', 'Agenda\AgendaController@getAgendaAtByFechaUsuarioSobreTurno');
Route::name('agenda-gestion')->get('agenda/horarios/turno', 'Agenda\AgendaController@getAgendaAtencionByFechaTodos');
Route::name('agenda-gestion')->get('agenda/horarios/turno/medico', 'Agenda\AgendaController@getAgendaAtencionByFechaAndMedico');
Route::name('agenda-gestion')->get('agenda/horarios/turno/medico/noestado', 'Agenda\AgendaController@getAgendaAtencionByFechaAndMedicoSinEstado');
Route::name('agenda-gestion')->get('agenda/horarios/turno/todos/noestado', 'Agenda\AgendaController@getAgendaAtencionByFechaTodosSinEstado');
Route::name('agenda-gestion')->get('agenda/horarios/turno/todos/noestado/bydates', 'Agenda\AgendaController@getAgendaAtencionByFechaTodosSinEstadoBetweenDates');
Route::name('agenda-gestion')->get('agenda/horarios/turno/todos/noestado/bydates/gerencia', 'Agenda\AgendaController@getAgendaAtencionByFechaTodosSinEstadoBetweenDatesGerencia');
Route::name('agenda-gestion')->get('agenda/horarios/turno/nuevo', 'Agenda\AgendaController@getAgendaAtByFechaTodosTurnos');
Route::name('agenda-gestion')->get('agenda/horarios/turno/nuevo/usuario', 'Agenda\AgendaController@getAgendaAtByFechaMedicoTurnos');
Route::name('agenda-gestion')->get('agenda/horarios/turno/nuevo/usuario/todos', 'Agenda\AgendaController@getAgendaAtByFechaMedicoTurnosTodos');
Route::name('agenda-gestion')->get('agenda/horarios', 'Agenda\AgendaController@getAgendaByHorarios');
Route::name('agenda-gestion')->get('agenda/medico/dia', 'Agenda\AgendaController@getAgendaByMedicoAndDia');
Route::name('agenda-gestion')->put('agenda/deshabilitar/{id}', 'Agenda\AgendaController@DeshabilitarHorarioByMedico');
Route::name('agenda-gestion')->get('agenda/medico/todo', 'Agenda\AgendaController@getAgendaByMedicoAndDiaTodoEstado');
Route::name('agenda-gestion')->get('agenda/medico/disponilible', 'Agenda\AgendaController@getAgendaByMedicoAndDiaDisponible');
Route::name('agenda-gestion')->get('agenda/todos/disponilible', 'Agenda\AgendaController@getAgendaByDiaDisponible');
Route::name('agenda-gestion')->post('agenda/crear/medico', 'Agenda\AgendaController@generarHorarioAgenda');
Route::name('agenda-gestion')->get('agenda/crearhorario', 'Agenda\AgendaController@crearAgendaByHorario');
Route::name('agenda-gestion')->post('agenda/asignar/turno', 'Agenda\AgendaController@asignarTurno');
Route::name('agenda-gestion')->get('agenda/horarios/dias', 'Agenda\AgendaController@getDias');
Route::name('agenda-gestion')->get('agenda/horarios/periodo', 'Agenda\AgendaController@getHorario');
Route::name('agenda-gestion')->get('agenda/horarios/horarios/bloquear/turno', 'Agenda\AgendaController@bloquearAgendaTurno');
Route::name('agenda-gestion')->post('agenda/horarios/horarios/bloquear/periodo', 'Agenda\AgendaController@bloquearAgenda');
Route::name('agenda-gestion')->get('agenda/horarios/horarios/bloquear/medico', 'Agenda\AgendaController@getAgendaBloqueoByMedicoAndDiaTodoEstado');
Route::name('agenda-gestion')->get('agenda/horarios/medico/bloqueado', 'Agenda\AgendaController@getAgendaBloqueo');
Route::name('agenda-gestion')->get('agenda/horarios/paciente/historia/{id}', 'Agenda\AgendaController@getHistoriaPaciente');
Route::name('agenda-gestion')->get('agenda/horarios/paciente/cancelar/{id}', 'Agenda\AgendaController@cancelarTurno');
Route::name('agenda-gestion')->get('agenda/horarios/turno/eliminado', 'Agenda\AgendaController@getAgendaEliminados');
Route::name('agenda-gestion')->get('agenda/horarios/turno/todos', 'Agenda\AgendaController@getAgendaAtencionByFechaTurnosTodos');
Route::name('agenda-gestion')->get('agenda/horarios/turno/presente', 'Agenda\AgendaController@getAgendaAtencionPresente');
Route::name('agenda-gestion')->get('agenda/horarios/turno/otrosestados', 'Agenda\AgendaController@getAgendaAtencionOtrosEstados');
Route::name('agenda-gestion')->put('agenda/horarios/turno/operacioncobro/actualizar/{id}', 'Agenda\AgendaController@updateAgendaOperacionCobro');
Route::name('agenda-gestion')->get('agenda/horarios/bloqueo/turno', 'Agenda\AgendaController@getHorarioBloqueoByMedico');
Route::name('agenda-gestion')->get('agenda/horarios/bloqueo/dia', 'Agenda\AgendaController@getDiasBloqueados');
Route::name('agenda-gestion')->get('agenda/horarios/cancelar/horario/{id}', 'Agenda\AgendaController@deleteAgendaMedicoHorario');
Route::name('agenda-gestion')->get('agenda/horarios/cancelar/agenda/{id}', 'Agenda\AgendaController@deleteAgendaMedico');
Route::name('agenda-gestion')->get('agenda/turno/by/paciente', 'Agenda\AgendaController@getTurnoPacienteByfecha');
Route::name('agenda-gestion')->put('agenda/turno/presente/{id}', 'Agenda\AgendaController@updatePresente');
Route::name('agenda-gestion')->put('agenda/turno/derivado/{id}', 'Agenda\AgendaController@pacienteDerivado');
Route::name('agenda-gestion')->get('agenda/turno/pantalla/llamando', 'Agenda\AgendaController@ActualizarTurnoLlamando');
Route::name('agenda-gestion')->get('agenda/turno/pantalla/puesto/llamando', 'Agenda\AgendaController@getPuestoLlamando');


/****TOTEM */
Route::name('totem')->put('totem/turno/presente/{id}', 'Agenda\AgendaController@updatePresente');
Route::name('totem')->post('totem/paciente/nuevo', 'Agenda\AgendaController@turnoRecepcionPacienteNuevo');
Route::name('totem')->post('totem/paciente/existente', 'Agenda\AgendaController@turnoRecepcionPacienteExistente');
Route::name('totem')->get('totem/turno/by/paciente', 'Agenda\AgendaController@getTurnoByPaciente');
Route::name('totem')->get('totem/turno/nuevo', 'Agenda\AgendaController@totemGenerarTurnoPacienteNuevo');
Route::name('totem')->get('totem/turno/existente', 'Agenda\AgendaController@totemGenerarTurnoPacienteExistente');
Route::name('totem')->put('totem/turno/llamar', 'Agenda\AgendaController@llamarTurnoPaciente');

/****PANTALLA */
Route::name('totem')->get('pantalla/turno/llamando', 'Agenda\AgendaController@getTurnoPantallaLlamando');
Route::name('totem')->get('pantalla/turno/ingresado', 'Agenda\AgendaController@getTurnoPantallaAtendido');


/** CIRUGIA **/
Route::name('historia-clinica')->get('cirugia/historia/{id}', 'Cirugia\CirugiaController@getHistoriaClinicaByPaciente');
Route::name('historia-clinica')->get('cirugia/historia/actualizar/paciente', 'Cirugia\CirugiaController@actualizarRegistroHistoriaClinica');
Route::name('historia-clinica')->post('cirugia/historia/registro/insertar', 'Cirugia\CirugiaController@setHistoriaClinicaFicha');
Route::name('historia-clinica')->put('cirugia/historia/registro/actualizar/{id}', 'Cirugia\CirugiaController@updHistoriaClinicaById');

/** ASESORAMIENTO **/
Route::name('cirugia')->get('cirugia/ficha/ficha/estado/{estado}', 'Cirugia\CirugiaController@getFichaQuirurgica');
Route::name('cirugia')->get('cirugia/ficha/completa/{estado}', 'Cirugia\CirugiaController@getFichaQuirurgicaCompleta');
Route::name('cirugia')->get('cirugia/ficha/grupomedico/{id}', 'Cirugia\CirugiaController@getFichaQuirurgicaGrupoMedico');
Route::name('cirugia')->get('cirugia/ficha/estudios/{id}', 'Cirugia\CirugiaController@ getFichaQuirurgicaEstudios');
Route::name('cirugia')->get('cirugia/ficha/anestesia/{id}', 'Cirugia\CirugiaController@getFichaQuirurgicaAnestesia');
Route::name('cirugia')->get('cirugia/ficha/practica/{id}', 'Cirugia\CirugiaController@ getFichaQuirurgicaPractica');
Route::name('cirugia')->get('cirugia/ficha/rendicion/{id}', 'Cirugia\CirugiaController@getFichaQuirurgicaRendicion');
Route::name('cirugia')->get('cirugia/ficha/lente/{id}', 'Cirugia\CirugiaController@getFichaQuirurgicaLente');
Route::name('cirugia')->get('cirugia/ficha/cirugia/estado', 'Cirugia\CirugiaController@getCirugiaEstado');

Route::name('cirugia')->post('cirugia/ficha/derivar', 'Cirugia\CirugiaController@crearRegistroCirugia');
Route::name('cirugia')->post('cirugia/grupomedico', 'Cirugia\CirugiaController@crearRegistroGrupoMedico');
Route::name('cirugia')->post('cirugia/estudios', 'Cirugia\CirugiaController@crearRegistroCirugiaGrupoMedico');
Route::name('cirugia')->post('cirugia/anestesia', 'Cirugia\CirugiaController@crearRegistroAnestesia');
Route::name('cirugia')->put('cirugia/practica/{id}', 'Cirugia\CirugiaController@actualizarRegistroCirugiaPractica');
Route::name('cirugia')->put('cirugia/practica/estado/{id}', 'Cirugia\CirugiaController@actualizarRegistroCirugiaEstado');
Route::name('cirugia')->post('cirugia/registro/lente', 'Cirugia\CirugiaController@crearRegistroLente');


Route::name('cirugia')->put('cirugia/grupomedico/{id}', 'Cirugia\CirugiaController@actualizarRegistroCirugiaGrupoMedico');
Route::name('cirugia')->put('cirugia/anestesia/{id}',   'Cirugia\CirugiaController@actualizarRegistroCirugiaEstudios');

Route::name('cirugia')->get('cirugia/ficha/registro/delete',    'Cirugia\CirugiaController@destroyRegistroLenteFichaQuirugica');
Route::name('cirugia')->get('cirugia/ficha/derivar/listado',    'Cirugia\CirugiaController@getFichAsesoramientoDerivados');
Route::name('cirugia')->put('cirugia/ficha/derivar/listado/atender/{id}',    'Cirugia\CirugiaController@actualizarFichAsesoramientoDerivados');
Route::name('cirugia')->delete('cirugia/ficha/listado/{id}', 'Cirugia\CirugiaController@destroyCirugiaListado');



/**********listado de cirugia previa */
//Route::name('cirugia')->get('cirugia/listado/quirofano',    'Cirugia\CirugiaController@getFichaQuirurgicaListadoQuirofano');
//Route::name('cirugia')->put('cirugia/listado/quirofano',    'Cirugia\CirugiaController@actualizarRegistroCirugiaAnestesia');
Route::name('cirugia')->post('cirugia/listado/quirofano', 'Cirugia\CirugiaController@createListadoQuirofano');
Route::name('cirugia')->get('cirugia/listado/quirofano',    'Cirugia\CirugiaController@getListadoQuirofano');
Route::name('cirugia')->get('cirugia/listado/quirofano/by/medico',    'Cirugia\CirugiaController@getListadoQuirofanoByMedico');
Route::name('cirugia')->get('cirugia/listado/quirofano/by/medico/by/periodo',    'Cirugia\CirugiaController@getListadoQuirofanoByMedicoByPeriodo');
Route::name('cirugia')->get('cirugia/listado/quirofano/realizado',    'Cirugia\CirugiaController@getFichaQuirurgicaRealizado');
Route::name('cirugia')->put('cirugia/listado/quirofano/{id}',    'Cirugia\CirugiaController@updateListadoQuirofano');



/** CONVENIOS **/
Route::resource('obrasocial', 'ObraSocial\ObraSocialController');
Route::name('obra-social')->get('obrasocialby/obrasocialpmo', 'ObraSocial\ObraSocialController@obraSocialByIdAndPmoId');
Route::name('obra-social')->get('obrasocialby/generarcoseguro', 'ObraSocial\ObraSocialController@generarCoseguros');
Route::name('obra-social')->get('obrasocialby/actualizarcoseguro', 'ObraSocial\ObraSocialController@actualizarCoseguros');
Route::name('obra-social')->get('obrasocialby/insertarcoseguro', 'ObraSocial\ObraSocialController@insertarConvenioCoseguro');
Route::name('obra-social')->get('obrasocialby/actualizar/distribucion', 'ObraSocial\ConvenioObraSocialController@ActualizarValoresDistribucion');

Route::resource('convenio', 'ObraSocial\ConvenioObraSocialController');
Route::name('convenio-obra-social')->get('convenio/byobrasocial/{id}', 'ObraSocial\ConvenioObraSocialController@findByObraSocial');
Route::name('convenio-obra-social')->get('convenio/bypmo/{id}', 'ObraSocial\ConvenioObraSocialController@findByPmo');
Route::name('convenio-obra-social')->get('convenio/by/obrasocialandcoseguro', 'ObraSocial\ConvenioObraSocialController@findByObraSocialAndCoseguro');


Route::resource('pmo', 'ObraSocial\PmoController');

/**FACTURACION**/

Route::resource('liquidacion/entidad', 'Liquidacion\EntidadFacturaController');
Route::name('liquidacion')->get('liquidacion/detalle', 'OperacionCobro\OperacionCobroController@getLiquidacionDetalle');
Route::name('liquidacion')->post('liquidacion/detalle/prefactura', 'OperacionCobro\OperacionCobroController@getListadoPreFactura');
Route::name('liquidacion')->post('liquidacion/detalle/prefactura/cirugia', 'OperacionCobro\OperacionCobroController@getListadoPreFacturaCirugia');
Route::name('liquidacion')->post('liquidacion/detalle/prefactura/cirugia/coseguro', 'OperacionCobro\OperacionCobroController@getListadoPreFacturaCirugiaCoseguro');
Route::name('liquidacion')->get('liquidacion/detalle/prefactura/desafectar', 'OperacionCobro\OperacionCobroController@desafectarPresentacion');
Route::name('liquidacion')->post('liquidacion/distribucion/medico', 'OperacionCobro\OperacionCobroController@liquidarOperacionCobro');

Route::name('liquidacion')->post('liquidacion/distribucion/clonar', 'OperacionCobro\OperacionCobroController@clonarLiquidacion');

/** DISTRIBUCION */

Route::name('distribucion')->post('distribucion/operacion/cobro/medico', 'Liquidacion\LiquidacionController@liquidacionDistribuir');
Route::name('distribucion')->put('distribucion/operacion/cobro/medico/actualizar/{id}', 'Liquidacion\LiquidacionController@liquidacionDistribuirActualizar');

/**PACIENTE**/

Route::resource('paciente', 'Paciente\PacienteController');
Route::name('paciente-consulta')->get('paciente/by/consulta', 'Paciente\PacienteController@getPacienteByQuery');
Route::name('paciente-consulta')->get('paciente/obrasocial/habilitada/{id}', 'Paciente\PacienteController@pacienteAndObraSocialEsHabilitada');
Route::name('paciente-consulta')->get('paciente/obrasocial/habilitada/todas/{id}', 'Paciente\PacienteController@pacienteAndObraSocialEsTodas');
Route::resource('pacienteobrasocial', 'Paciente\PacienteObraSocialController');
Route::resource('pacienteagenda', 'Paciente\PacienteAgendaController');
Route::name('pacienteagenda')->get('pacienteagenda/bydate/today', 'Paciente\PacienteAgendaController@byDateToday');
Route::name('pacienteagenda')->get('pacienteagenda/bydateselected/{fecha}','Paciente\PacienteAgendaController@byDateSelected');
Route::name('pacienteagenda')->get('pacienteagenda/bydatedni/{dni}','Paciente\PacienteAgendaController@byDni');
Route::name('paciente-consulta')->get('paciente/totem/dni', 'Paciente\PacienteController@getPacienteByDni');
/**OPERACION DE COBRO**/
Route::resource('operacioncobro', 'OperacionCobro\OperacionCobroController');
Route::name('operacioncobro')->post('operacioncobro/registros', 'OperacionCobro\OperacionCobroController@registroOperacionCobro');
Route::name('operacioncobro')->get('operacioncobro/registros/by/dates', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistrosBetweenDates');
Route::name('operacioncobro')->get('operacioncobro/registros/by/dates/medico', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistrosBetweenDatesAndMedico');
Route::name('operacioncobro')->get('operacioncobro/registros/by/id', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistrosById');
Route::name('operacioncobro')->get('operacioncobro/registros/by/operacioncobro', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistrosByIdOperacionCobro');
Route::name('operacioncobro')->get('operacioncobro/registros/by/paciente', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistrosBypacienteId');

Route::name('operacioncobro')->get('operacioncobro/registros/by/liquidacion/numero', 'OperacionCobro\OperacionCobroController@getPresentacionDetalleById');
Route::name('operacioncobro')->post('operacioncobro/registros/by/liquidacion/numero/multiple', 'OperacionCobro\OperacionCobroController@getPresentacionDetalleByMultipleId');
Route::name('operacioncobro')->get('operacioncobro/registros/by/distribucion', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistroDistribucionById');
Route::name('operacioncobro')->get('operacioncobro/registros/by/distribucion/prefactura', 'OperacionCobro\OperacionCobroController@getOperacionCobroRegistroDistribucionByIdPrefactura');

Route::name('operacioncobro')->post('operacioncobro/facturacion/auditarorden', 'OperacionCobro\OperacionCobroController@auditarOrdenes');
Route::name('operacioncobro')->post('operacioncobro/afectar/orden', 'OperacionCobro\OperacionCobroController@afectarOperacionCobro');
Route::name('operacioncobro')->post('operacioncobro/distribuir/orden', 'OperacionCobro\OperacionCobroController@DistribuirOperacionCobro');
Route::name('operacioncobro')->post('operacioncobro/distribuir/orden/liquidar', 'OperacionCobro\OperacionCobroController@DistribuirOperacionCobroLiquidar');
Route::name('operacioncobro')->delete('operacioncobro/practica/{id}', 'OperacionCobro\OperacionCobroController@destroyByPracticaById');
Route::name('operacioncobro')->put('operacioncobro/practica/actualizar/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroPractica');
Route::name('operacioncobro')->put('operacioncobro/practica/anular/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroPracticaAnular');
Route::name('operacioncobro')->put('operacioncobro/practica/editar/distribucion/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroDistribucion');
Route::name('operacioncobro')->put('operacioncobro/practica/editar/distribucion/operacioncobro/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroDistribucionOperacionCobro');
Route::name('operacioncobro')->put('operacioncobro/operacioncobro/actualizar/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroPrincipal');
Route::name('operacioncobro')->put('operacioncobro/presentacion/actualizar/{id}', 'OperacionCobro\OperacionCobroController@updatePresentacion');
Route::name('operacioncobro')->get('operacioncobro/consulta/varios', 'OperacionCobro\OperacionCobroController@operacionCobroByCondicion');
Route::name('operacioncobro')->get('operacioncobro/consulta/varios/distribucion', 'OperacionCobro\OperacionCobroController@operacionCobroByDistribucion');
Route::name('operacioncobro')->get('operacioncobro/distribucion/recalcular/by/fecha', 'OperacionCobro\OperacionCobroController@updateValoresDistribucionBetwenDates');
Route::name('operacioncobro')->put('operacioncobro/registro/prestacion/{id}', 'OperacionCobro\OperacionCobroController@updateOperacionCobroPrestacion');
Route::name('operacioncobro')->post('operacioncobro/recalcular/by/liquidacion', 'OperacionCobro\OperacionCobroController@updateOperacionCobroValoresByNumeroAfectacion');
Route::name('operacioncobro')->get('operacioncobro/distribucion/by/operacioncobro', 'OperacionCobro\OperacionCobroController@getDistribucionbyOperacionCobro');
Route::name('operacioncobro')->post('operacioncobro/distribucion/expediente', 'OperacionCobro\OperacionCobroController@GetDistribucionByExpediente');
Route::name('operacioncobro')->post('operacioncobro/distribucion/medico', 'OperacionCobro\OperacionCobroController@GetDistribucionByMedico');
Route::name('operacioncobro')->post('operacioncobro/distribucion/medico/detalle', 'OperacionCobro\OperacionCobroController@GetDistribucionByMedicoDetalle');
Route::name('operacioncobro')->get('operacioncobro/distribucion/numero', 'OperacionCobro\OperacionCobroController@GetDistribucionByNumero');
Route::name('operacioncobro')->post('operacioncobro/liquidacion/generdada/id', 'OperacionCobro\OperacionCobroController@generarLiquidacionNumero');
Route::name('operacioncobro')->get('operacioncobro/liquidacion/generdada', 'OperacionCobro\OperacionCobroController@getLiquidacionNumero');


/**FACTURACION **/

Route::resource('practica', 'Practica\PracticaController');
Route::name('practica')->get('practica/byobrasocial/{id}', 'Practica\PracticaController@byobrasocial');
Route::name('practica')->get('practica/by/{obrasocialmedico}', 'Practica\PracticaController@byObrasocialAndMedico');
Route::name('practica')->get('practica/by/fecha/{orden}', 'Practica\PracticaController@showBetweenDate');
Route::name('practica')->get('practica/by/liquidacion/{id}', 'Practica\PracticaController@byLiquidacionId');
Route::name('practica')->get('practica/by/agenda/{id}', 'Practica\PracticaController@byAgendaId');

Route::resource('liquidacion', 'Liquidacion\LiquidacionController');
Route::name('liq')->get('liquidacion/by/generacion/{id}', 'Liquidacion\LiquidacionController@byLiquidacionGenerada');

Route::resource('liquidaciongenerada', 'Liquidacion\LiquidacionGeneradaController');

Route::resource('practicadistribucion', 'Practica\PracticaDistribucionController');
Route::name('practicadistribucion')->get('practicadistribucion/byconvenioospmo/{id}', 'Practica\PracticaDistribucionController@bypractica');

/** STOCK **/
Route::name('stock')->get('stock/lente/by/todos', 'Cirugia\CirugiaController@GetLentes');
Route::name('stock')->get('stock/lente/by/dates/todos', 'Cirugia\CirugiaController@getLentesByDates');
Route::name('stock')->get('stock/lente/by/dates', 'Cirugia\CirugiaController@getLentesCirugiaByDates');
Route::name('stock')->get('stock/lente/by/dates/baja', 'Cirugia\CirugiaController@getLentesCirugiaByDatesAndBaja');
Route::name('stock')->post('stock/lente', 'Cirugia\CirugiaController@crearLente');
Route::name('stock')->put('stock/lente/{id}', 'Cirugia\CirugiaController@actualizarLente');
Route::name('stock')->get('lente/lente', 'Cirugia\CirugiaController@getLenteTipo');

/** FILE MANAGER **/
Route::name('archivos')->post('/multiuploads/estudios', 'Upload\UploadController@showUploadFile');
Route::name('archivos')->post('/multiuploads/estudios/datos', 'Upload\UploadController@showUploadFileDatos');
Route::name('archivos')->post('/multiuploads/texto', 'Files\FilesController@createTestTextFile');
Route::name('archivos')->post('/multiuploads/texto/cirugia', 'Files\FilesController@createTestTextFileCirugia');
Route::name('archivos')->get('/multiuploads/estudios/verimagen', 'Upload\UploadController@getEstudioImagenes');
Route::name('archivos')->get('/multiuploads/documentacion', 'Files\FilesController@getDocumentacion');

/** CHAT **/

Route::name('chat')->get('chat/encriptar', 'notificacion\ChatController@encriptarTexto');
Route::name('chat')->get('chat/desencriptar', 'notificacion\ChatController@desEncriptarTexto');

Route::name('notificacion')->get('notificacion/notificacion/by/notificacion', 'notificacion\notificacionController@getNotificacionesBynotificacionId');
Route::name('notificacion')->get('notificacion/notificacion/by/usuario', 'notificacion\notificacionController@getNotificacionesByUsuario');
Route::name('notificacion')->post('notificacion/usuario', 'notificacion\notificacionController@crearNotificacion');
Route::name('notificacion')->put('notificacion/notificacion/{id}', 'notificacion\notificacionController@confirmarNotificacionByUsuario');


/*** FACTURA ELECTRONICA */


/**** INFORMACION SOBRE LOS COMPROBANTES */


Route::name('factura-data')->get('afip/data/medicos/facturan', 'Afip\AfipController@getMedicosFacturan');

Route::name('factura-data')->get('afip/data/getlastvoucher', 'Afip\AfipDatosController@GetLastVoucher');
Route::name('factura-data')->get('afip/data/getiformacioncomprobante', 'Afip\AfipDatosController@getIformacionComprobante');
Route::name('factura-data')->get('afip/data/tipocomprobantesdisponibles', 'Afip\AfipDatosController@TipoComprobantesDisponibles');
Route::name('factura-data')->get('afip/data/tipoconceptosdisponibles', 'Afip\AfipDatosController@GetConceptTypes');
Route::name('factura-data')->get('afip/data/tipodocumentosdisponibles', 'Afip\AfipDatosController@TipoDocumentosDisponibles');
Route::name('factura-data')->get('afip/data/tipoalicuotasdisponibles', 'Afip\AfipDatosController@TipoAlicuotasDisponibles');
Route::name('factura-data')->get('afip/data/getoptionstypes', 'Afip\AfipDatosController@GetOptionsTypes');
Route::name('factura-data')->get('afip/data/gettaxtypes', 'Afip\AfipDatosController@GetTaxTypes');
Route::name('factura-data')->get('afip/data/getconcepttypes', 'Afip\AfipDatosController@GetConceptTypes');
Route::name('factura-data')->get('afip/data/obetenerestadodelservidor', 'Afip\AfipDatosController@ObetenerEstadoDelServidor');
Route::name('factura-data')->get('afip/data/medico/dato', 'Afip\AfipController@getDatoMedico');
Route::name('factura-data')->get('afip/data/comprobante/by/medico', 'Afip\AfipController@getComprobanteXMedico');

Route::name('factura')->get('afip/lastvoucher', 'Afip\AfipController@testAfipGetLastVoucher');
Route::name('factura')->get('afip/test', 'Afip\AfipController@testAfip');
Route::name('factura')->get('afip/factura/a', 'Afip\AfipController@CrearFacturaA');
Route::name('factura')->get('afip/factura/b', 'Afip\AfipController@CrearFacturaB');
Route::name('factura')->get('afip/factura/c', 'Afip\AfipController@CrearFacturaC');

Route::name('factura')->get('afip/notacredito/a', 'Afip\AfipController@CrearNotaCreditoA');
Route::name('factura')->get('afip/notacredito/b', 'Afip\AfipController@CrearNotaCreditoB');
Route::name('factura')->get('afip/notacredito/c', 'Afip\AfipController@CrearNotaCreditoC');

Route::name('factura')->get('afip/factura/info', 'Afip\AfipController@GetVoucherInfo');


/**** ELEMENTOS FACTURACION */

Route::name('facturacion-elementos')->get('afip/elementos/alicuota', 'Afip\FacturaElementosController@Alicuota');
Route::name('facturacion-elementos')->get('afip/elementos/alicuota/asociada', 'Afip\FacturaElementosController@AlicuotaAsociada');
Route::name('facturacion-elementos')->get('afip/elementos/comprobante', 'Afip\FacturaElementosController@Comprobante');
Route::name('facturacion-elementos')->get('afip/elementos/concepto', 'Afip\FacturaElementosController@Concepto');
Route::name('facturacion-elementos')->get('afip/elementos/documento', 'Afip\FacturaElementosController@Documento');
Route::name('facturacion-elementos')->get('afip/elementos/pto/vta', 'Afip\FacturaElementosController@PtoVta');
Route::name('facturacion-elementos')->get('afip/elementos/categoria/iva', 'Afip\FacturaElementosController@CategoriaIva');
Route::name('facturacion-elementos')->post('afip/elementos/factura/nueva', 'Afip\FacturaElementosController@crearFactura');
Route::name('facturacion-elementos')->get('afip/elementos/factura', 'Afip\FacturaElementosController@GetFacturaByid');
Route::name('facturacion-elementos')->post('afip/elementos/factura/nota/credito', 'Afip\FacturaElementosController@crearFacturaNotaCredito');
Route::name('facturacion-elementos')->get('afip/elementos/factura/by/fecha', 'Afip\FacturaElementosController@GetFacturaBetweenDates');
Route::name('facturacion-elementos')->get('afip/elementos/factura/by/cliente', 'Afip\FacturaElementosController@GetFacturaByNameOrDocumento');
Route::name('facturacion-elementos')->get('afip/elementos/factura/by/id', 'Afip\FacturaElementosController@FacturaById');
Route::name('facturacion-elementos')->get('afip/elementos/factura/libro/iva', 'Afip\FacturaElementosController@getLibroIva');

Route::name('facturacion-elementos')->get('afip/elementos/articulo', 'Afip\FacturaElementosController@FacturaArticulo');
Route::name('facturacion-elementos')->post('afip/elementos/articulo', 'Afip\FacturaElementosController@CrearFacturaArticulo');
Route::name('facturacion-elementos')->put('afip/elementos/articulo/{id}', 'Afip\FacturaElementosController@ActualizarFacturaArticulo');
Route::name('facturacion-elementos')->get('afip/elementos/articulo/tipo', 'Afip\FacturaElementosController@GetFacturaByArticuloTipo');
Route::name('facturacion-elementos')->put('afip/elementos/articulo/tipo/{id}', 'Afip\FacturaElementosController@ActualizarFacturaArticuloTipo');
Route::name('facturacion-elementos')->post('afip/elementos/articulo/tipo', 'Afip\FacturaElementosController@CrearFacturaArticuloTipo');


/****************** LISTAS ************** */



Route::name('listas')->get('lista/cirugia', 'lista\ListaController@getListaCirugia');
Route::name('listas')->put('lista/cirugia/{id}', 'lista\ListaController@ActualizarListaCirugia');
Route::name('listas')->post('lista/cirugia', 'lista\ListaController@CrearListaCirugia');

Route::name('listas')->get('lista/estudio', 'lista\ListaController@getListaEstudios');
Route::name('listas')->put('lista/estudio/{id}', 'lista\ListaController@ActualizarListaEstudios');
Route::name('listas')->post('lista/estudio', 'lista\ListaController@CrearListaEstudios');

Route::name('listas')->get('lista/receta', 'lista\ListaController@getListaReceta');
Route::name('listas')->put('lista/receta/{id}', 'lista\ListaController@ActualizarListaReceta');
Route::name('listas')->post('lista/receta', 'lista\ListaController@CrearListaReceta');

Route::name('listas')->get('lista/obrasocial/autorizacion', 'lista\ListaController@getListaObraSocial');
Route::name('listas')->put('lista/obrasocial/autorizacion/{id}', 'lista\ListaController@ActualizarListObraSocial');
Route::name('listas')->post('lista/obrasocial/autorizacion', 'lista\ListaController@CrearListaObraSocial');

/* -------------------------------------------------------------------------- */
/*                                    CHAT                                    */
/* -------------------------------------------------------------------------- */

Route::name('chat')->get('chat/usuario/alta', 'Chat\ChatController@altaUsuarioSesionLista');
Route::name('chat')->get('chat/usuario/alta/sesion', 'Chat\ChatController@crearSesionListado');
Route::name('chat')->get('chat/usuario/alta/sesion/grupo', 'Chat\ChatController@asociarUsuarioGrupo');
Route::name('chat')->get('chat/alta/sesion/grupo', 'Chat\ChatController@crearSesionListadoGrupo');
Route::name('chat')->get('chat/usuario/lista/sesion', 'Chat\ChatController@getSesionListByUsuario');
Route::name('chat')->get('chat/usuario/lista/sesion/grupo', 'Chat\ChatController@getSesionListByGrupo');
Route::name('chat')->post('chat/renglon', 'Chat\ChatController@insertarRenglonChat');
Route::name('chat')->get('chat/renglon/leido', 'Chat\ChatController@actualizarRenglonListado');
Route::name('chat')->get('chat/by/sesion', 'Chat\ChatController@getChatBySesion');
Route::name('chat')->get('chat/grupos', 'Chat\ChatController@getGrupos');
Route::name('chat')->post('/chat/adjuntar/{sesion_id}/{usuario_id}', 'Chat\ChatController@showUploadFile');
Route::name('chat')->get('chat/grupo/detalle/usuarios', 'Chat\ChatController@getGrupoDetalleUsuarios');
Route::name('chat')->get('chat/grupo/detalle/usuarios/borrar', 'Chat\ChatController@destroyUsuarioGrupoSesion');



/* -------------------------------------------------------------------------- */
/*                                   INSUMOS                                  */
/* -------------------------------------------------------------------------- */


Route::name('insumo')->get('insumo/activo', 'Insumo\InsumoController@getInsumo');
Route::name('insumo')->post('insumo/nuevo', 'Insumo\InsumoController@crearInsumo');
Route::name('insumo')->put('insumo/actualizar/{id}', 'Insumo\InsumoController@actualizarInsumo');
Route::name('insumo')->post('insumo/stock/nuevo', 'Insumo\InsumoController@crearInsumoStock');
Route::name('insumo')->post('insumo/stock/movimiento', 'Insumo\InsumoController@crearInsumoStockMovimiento');
Route::name('insumo')->get('insumo/stock', 'Insumo\InsumoController@getInsumoStock');
Route::name('insumo')->get('insumo/stock/movimiento', 'Insumo\InsumoController@getInsumoStockMovimiento');


/* -------------------------------------------------------------------------- */
/*                             MOVIMIENTOS DE CAJA                            */
/* -------------------------------------------------------------------------- */
Route::name('movimiento-caja')->get('movimiento/concepto/moneda', 'MovimientosCaja\MovimientosCajaController@getConceptoMoneda');
Route::name('movimiento-caja')->get('movimiento/concepto/monedas', 'MovimientosCaja\MovimientosCajaController@getConceptoMonedas');
Route::name('movimiento-caja')->post('movimiento/concepto/moneda', 'MovimientosCaja\MovimientosCajaController@setConceptoMoneda');
Route::name('movimiento-caja')->put('movimiento/concepto/moneda/{id}', 'MovimientosCaja\MovimientosCajaController@putConceptoMoneda');

Route::name('movimiento-caja')->get('movimiento/concepto/comprobante', 'MovimientosCaja\MovimientosCajaController@getConceptoTipoComprobante');
Route::name('movimiento-caja')->get('movimiento/concepto/comprobantes', 'MovimientosCaja\MovimientosCajaController@getConceptoTipoComprobantes');
Route::name('movimiento-caja')->post('movimiento/concepto/comprobante', 'MovimientosCaja\MovimientosCajaController@setConceptoTipoComprobante');
Route::name('movimiento-caja')->put('movimiento/concepto/comprobante/{id}', 'MovimientosCaja\MovimientosCajaController@putConceptoTipoComprobante');

Route::name('movimiento-caja')->get('movimiento/concepto/cuenta', 'MovimientosCaja\MovimientosCajaController@getConceptoCuenta');
Route::name('movimiento-caja')->get('movimiento/concepto/cuentas', 'MovimientosCaja\MovimientosCajaController@getConceptoCuentas');
Route::name('movimiento-caja')->post('movimiento/concepto/cuenta', 'MovimientosCaja\MovimientosCajaController@setConceptoCuenta');
Route::name('movimiento-caja')->put('movimiento/concepto/cuenta/{id}', 'MovimientosCaja\MovimientosCajaController@putConceptoCuenta');

Route::name('movimiento-caja')->get('movimiento/cuenta', 'MovimientosCaja\MovimientosCajaController@getCuenta');
Route::name('movimiento-caja')->get('movimiento/cuentas', 'MovimientosCaja\MovimientosCajaController@getCuentas');
Route::name('movimiento-caja')->post('movimiento/cuenta', 'MovimientosCaja\MovimientosCajaController@setCuenta');
Route::name('movimiento-caja')->put('movimiento/cuenta/{id}', 'MovimientosCaja\MovimientosCajaController@putCuenta');

Route::name('movimiento-caja')->get('movimiento/registro/by/date', 'MovimientosCaja\MovimientosCajaController@geRegistroMovimientoBydate');

Route::name('movimiento-caja')->post('movimiento/caja', 'MovimientosCaja\MovimientosCajaController@setMovimientoCaja');
Route::name('movimiento-caja')->put('movimiento/caja/{id}', 'MovimientosCaja\MovimientosCajaController@putMovimientoCaja');
/* -------------------------------------------------------------------------- */
/*                                  PROVEEDOR                                 */
/* -------------------------------------------------------------------------- */

Route::name('movimiento-caja')->get('proveedor', 'MovimientosCaja\MovimientosCajaController@getProveedor');
Route::name('movimiento-caja')->get('proveedores', 'MovimientosCaja\MovimientosCajaController@getProveedores');
Route::name('movimiento-caja')->post('proveedor', 'MovimientosCaja\MovimientosCajaController@setProveedor');
Route::name('movimiento-caja')->put('proveedor/{id}', 'MovimientosCaja\MovimientosCajaController@putProveedor');

