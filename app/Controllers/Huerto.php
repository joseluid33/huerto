<?php

namespace App\Controllers;

use App\Models\CultivoModel;
use DateTime;

class Huerto extends BaseController
{
    public function index()
    {
        $model = new CultivoModel();
        $cultivos = $model->findAll();
        $hoy = new DateTime();

        $requierenRiego = 0;
        $listosCosecha = 0;
        $cosechados = 0;

        foreach ($cultivos as &$cultivo) {
            $cultivo['requiere_riego'] = false;
            $cultivo['listo_cosechar'] = false;
            $cultivo['proximo_riego'] = null;
            $cultivo['fecha_cosecha_estimada'] = null;

            if ($cultivo['estado'] !== 'Cosechado') {
                if (! empty($cultivo['ultimo_riego'])) {
                    $ultimoRiego = new DateTime($cultivo['ultimo_riego']);
                    $proximoRiego = clone $ultimoRiego;
                    $proximoRiego->modify('+' . $cultivo['frecuencia_riego_dias'] . ' days');

                    $cultivo['proximo_riego'] = $proximoRiego->format('Y-m-d');
                    $cultivo['requiere_riego'] = $proximoRiego->format('Y-m-d') <= $hoy->format('Y-m-d');
                }

                $fechaSiembra = new DateTime($cultivo['fecha_siembra']);
                $fechaCosecha = clone $fechaSiembra;
                $fechaCosecha->modify('+' . $cultivo['dias_cosecha_estimados'] . ' days');

                $cultivo['fecha_cosecha_estimada'] = $fechaCosecha->format('Y-m-d');
                $cultivo['listo_cosechar'] = $fechaCosecha->format('Y-m-d') <= $hoy->format('Y-m-d');
            }

            if ($cultivo['requiere_riego']) {
                $requierenRiego++;
            }

            if ($cultivo['listo_cosechar']) {
                $listosCosecha++;
            }

            if ($cultivo['estado'] === 'Cosechado') {
                $cosechados++;
            }
        }

        return view('huerto/index', [
            'cultivos' => $cultivos,
            'totalCultivos' => count($cultivos),
            'requierenRiego' => $requierenRiego,
            'listosCosecha' => $listosCosecha,
            'cosechados' => $cosechados,
        ]);
    }
    public function nuevo()
    {
        return view('huerto/nuevo');
    }
    public function crear()
    {
        $model = new CultivoModel();

        $reglas = [
            'nombre_planta' => 'required',
            'variedad' => 'required',
            'fecha_siembra' => 'required',
            'dias_cosecha_estimados' => 'required|integer',
            'frecuencia_riego_dias' => 'required|integer',
            'ultimo_riego' => 'required',
            'estado' => 'required'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()
                ->withInput()
                ->with('errores', $this->validator->getErrors());
        }

        $datos = [
            'nombre_planta' => $this->request->getPost('nombre_planta'),
            'variedad' => $this->request->getPost('variedad'),
            'fecha_siembra' => $this->request->getPost('fecha_siembra'),
            'dias_cosecha_estimados' => $this->request->getPost('dias_cosecha_estimados'),
            'frecuencia_riego_dias' => $this->request->getPost('frecuencia_riego_dias'),
            'ultimo_riego' => $this->request->getPost('ultimo_riego'),
            'estado' => $this->request->getPost('estado')
        ];

        $model->save($datos);

        return redirect()->to('/')->with(
            'mensaje',
            'Cultivo creado correctamente'
        );
    }
    public function registrarRiego(int $id)
    {
        $model = new CultivoModel();

        $cultivo = $model->find($id);

        if (!$cultivo) {
            return redirect()->back()->with('error', 'Cultivo no encontrado');
        }

        $model->update($id, [
            'ultimo_riego' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('mensaje', 'Riego registrado correctamente');
    }

    public function cambiarEstado(int $id)
    {
        $model = new CultivoModel();

        $cultivo = $model->find($id);

        if (!$cultivo) {
            return redirect()->back()->with('error', 'Cultivo no encontrado');
        }

        $model->update($id, [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->back()->with('mensaje', 'Estado actualizado correctamente');
    }

    public function eliminar(int $id)
    {
        $model = new CultivoModel();

        $cultivo = $model->find($id);

        if (!$cultivo) {
            return redirect()->back()->with('error', 'Cultivo no encontrado');
        }

        $model->delete($id);

        return redirect()->back()->with('mensaje', 'Cultivo eliminado correctamente');
    }
}
