<?php
//llamando el archivo app
require_once '../../config/app.php';
//llamando el archivo modelo de la tabla categoria
require_once APP_PATH . '/app/models/Curso.php';
date_default_timezone_set("America/El_Salvador");
session_start();
try {
	//inicializando la clase de categoria
	$curso = new Curso;
	//si el post es para la datatable del crud de categoria
	if (isset($_POST['tabla'])) {
		switch ($_POST['tabla']) {
			case 'casa':
				if ($curso->setCodiCasa($_SESSION['codi_casa'])) {
					if (isset($_POST['fechInic']) && isset($_POST['fechFin'])) {
						$anioInicial = date('Y', strtotime($_POST['fechInic']));
						$anioFinal = date('Y', strtotime($_POST['fechFin']));
						$data = $curso->getCursoCasa($anioInicial, $anioFinal);
						echo $data;
					} else {
						$data = $curso->getCursoCasa(date('Y'), date('Y'));
						echo $data;
					}
				}
				break;
			case 'casas':
				if (isset($_POST['fechInicC']) && isset($_POST['fechFinC'])) {
					$anioInicialC = date('Y', strtotime($_POST['fechInicC']));
					$anioFinalC = date('Y', strtotime($_POST['fechFinC']));
					$dataC = $curso->getCursoCasas($anioInicialC, $anioFinalC);
					echo $dataC;
				} else {
					$dataC = $curso->getCursoCasas(date('Y'), date('Y'));
					echo $dataC;
				}
				break;
			case 'cursoHorario':
				$dataC = $curso->getCursoHorarioDia($_POST['codi_dia'], $_POST["codi_curs"]);
				echo $dataC;
				break;
		}
	}
	if (isset($_POST['finalizar'])) {
		if ($curso->setCodiCasa($_SESSION['codi_casa'])) {
			if ($curso->updateCursoFinalizado(date("Y-m-d"))) {
				throw new Exception("Exito");
			} else {
				throw new Exception("No se pudo");
			}
		}
	}
	//si el post es para una de las acciones del crud
	if (isset($_POST['accion'])) {
		//Validando los datos del formulario
		$_POST = $curso->validateForm($_POST);
		//switch para verificar que accion es la que se va a realizar
		switch ($_POST['accion']) {
			case 'verificarInfo':
				if ($_SESSION['codi_tipo_casa'] == 1) {
					throw new Exception('casas');
				} else {
					throw new Exception('casa');
				}
				break;
				//en el caso que la accion sea de crear una nueva categoria
			case 'create':
				if (isset($_POST['codiCate'])) {
					if ($curso->setCodiCate($_POST['codiCate'])) {
						if ($curso->setCodiCasa($_SESSION['codi_casa'])) {
							if ($curso->setCorrCurs($_POST['corrCurs'])) {
								if ($curso->setNombCurs($_POST['nombCurs'])) {
									if ($curso->setFechInic($_POST['fechInic'])) {
										if ($curso->setFechFin($_POST['fechFin'])) {
											if ($curso->setCantPart($_POST['cantPart'])) {
												if ($curso->setMontEsti($_POST['montEsti'])) {
													$cantidadCategoriaPresupuesto = $curso->obtenerCantPresCate(date("Y"));
													if (($cantidadCategoriaPresupuesto['cantidad'] - ($_POST['montEsti'] * $_POST['cantPart'])) >= 0) {
														$fechaInicio = strtotime($curso->getFechInic());
														$fechaFin = strtotime($curso->getFechFin());
														if ($fechaInicio != "") {
															if ($fechaFin != "") {
																if ($fechaInicio < $fechaFin) {
																	if ($curso->createCurso()) {
																		throw new Exception($curso->obtenerIdUltimo());
																	} else {
																		throw new Exception("No se pudo crear el curso");
																	}
																} else {
																	throw new Exception("La fecha inicial no puede ser mayor a la final");
																}
															} else {
																throw new Exception("Debe ingresar la fecha de finalizacion");
															}
														} else {
															throw new Exception("Debe ingresar la fecha de inicio");
														}
													} else {
														throw new Exception("La cantidad estimada es mayor a la cantidad restante del presupuesto: " . $cantidadCategoriaPresupuesto['cantidad']);
													}
												} else {
													throw new Exception("Debe ingresar el monto estimado del curso");
												}
											} else {
												throw new Exception("Debe ingresar una cantidad estimada de participantes del curso");
											}
										} else {
											throw new Exception("Verifique la fecha final");
										}
									} else {
										throw new Exception("Verifique la fecha inicial");
									}
								} else {
									throw new Exception("Verifique el nombre del curso");
								}
							} else {
								throw new Exception("Ingrese un correlativo correcto para el curso");
							}
						} else {
							throw new Exception("No se encontro la casa");
						}
					} else {
						throw new Exception("Seleccione la categoria del curso");
					}
				} else {
					throw new Exception("Seleccione la categoria del curso");
				}
				break;
				//en el caso de que la accion sea de modificar la categoria
			case 'update':
				if ($curso->setCodiCurs($_POST['codiCursUpda'])) {
					if ($curso->setCodiCate($_POST['codiCateUpda'])) {
						if ($curso->setCorrCurs($_POST['corrCursUpda'])) {
							if ($curso->setNombCurs($_POST['nombCursUpda'])) {
								if ($curso->setFechInic($_POST['fechInicUpda'])) {
									if ($curso->setFechFin($_POST['fechFinUpda'])) {
										if ($curso->setCantPart($_POST['cantPartUpda'])) {
											if ($curso->setMontEsti($_POST['montEstiUpda'])) {
												$cantidadCategoriaPresupuestoX = $curso->obtenerCantPresCateUpda(date("Y"), $_POST['codiCursUpda']);
												if (($cantidadCategoriaPresupuestoX['cantidad'] - ($_POST['montEstiUpda'] * $_POST['cantPartUpda'])) >= 0) {
													$fechaInicio = strtotime($curso->getFechInic());
													$fechaFin = strtotime($curso->getFechFin());
													if ($fechaInicio != "") {
														if ($fechaFin != "") {
															if ($fechaInicio < $fechaFin) {
																if ($curso->updateCurso()) {
																	throw new Exception("Exito");
																} else {
																	throw new Exception("No se pudo modificar el curso");
																}
															} else {
																throw new Exception("La fecha inicial no puede ser mayor a la final");
															}
														} else {
															throw new Exception("Debe ingresar la fecha de finalizacion");
														}
													} else {
														throw new Exception("Debe ingresar la fecha de inicio");
													}
												} else {
													$cantidadCategoriaPresupuestoX = $curso->obtenerCantPresCateUpda(date("Y"), $_POST['codiCursUpda']);
													throw new Exception("La cantidad estimada es mayor a la cantidad restante del presupuesto: " . $cantidadCategoriaPresupuestoX['cantidad']);
												}
											} else {
												throw new Exception("Debe ingresar el monto estimado del curso");
											}
										} else {
											throw new Exception("Debe ingresar la cantidad de participantes del curso");
										}
									} else {
										throw new Exception("Verifique la fecha final");
									}
								} else {
									throw new Exception("Verifique la fecha inicial");
								}
							} else {
								throw new Exception("Verifique el nombre del curso");
							}
						} else {
							throw new Exception('Debe ingresar el correlativo del curso');
						}
					} else {
						throw new Exception("Debe seleccionar la categoria");
					}
				} else {
					throw new Exception("No se ha encontrado el curso");
				}
				break;
			case 'delete':
				//si se setea con exito el codigo del registro
				if ($curso->setCodiCurs($_POST['codiCursDele'])) {
					//si se setea con exito el nombre del registro
					if ($curso->deleteCurso()) {
						throw new Exception("Exito");
					} else {
						//se envia mensaje de error
						throw new Exception('No se pudo eliminar el curso');
					}
				} else {
					//se envia mensaje de error
					throw new Exception('No se encontro el curso');
				}
				break;
			case 'informe':
				if ($curso->setCodiCurs($_POST['codiCurs'])) {
					if ($curso->setFechInfo(date("Y-m-d"))) {
						if ($curso->setUsuaInfo($_SESSION['codi_usua'])) {
							if ($curso->updateCursoInforme()) {
								throw new Exception("Exito");
							} else {
								throw new Exception("No se pudo modificar el estado del curso");
							}
						} else {
							throw new Exception("No se encontro el usuario");
						}
					} else {
						throw new Exception("Error al obtener la fecha de ingreso");
					}
				} else {
					throw new Exception("No se encontro el curso");
				}
				break;
			case 'informeAprovacion':
				if ($curso->setCodiCurs($_POST['codiCursAp'])) {
					switch ($_POST['codiCateAp']) {
						case 'FCO':
							if ($curso->updateCursoFactura()) {
								if ($curso->updateFactura()) {
									throw new Exception("Exito");
								} else {
									throw new Exception("No se pudo modificar el estado de la factura");
								}
							} else {
								throw new Exception("No se pudo modificar el estado del curso");
							}
							break;
						default:
							if ($curso->updateCursoInformeAprovacion()) {
								throw new Exception("Exito");
							} else {
								throw new Exception("No se pudo modificar el estado del curso");
							}
							break;
					}
				} else {
					throw new Exception("No se encontro el curso");
				}
				break;
		}
	}
} catch (Exception $error) {
	//enviando el mensaje ya sea de exito o de error en json
	echo json_encode($error->getMessage());
}
