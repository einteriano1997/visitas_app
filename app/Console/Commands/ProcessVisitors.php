<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDF;
use App\Models\Visitante;
use TCPDF;

class ProcessVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-visitors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $visitantes = Visitante::all();
    

        $pdf = new TCPDF();

         
 
        $logoPath = public_path('images/header.png');
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 10, 10, 50);
        }

        $footerPath = public_path('images/footer.png');
        if (file_exists($footerPath)) {
            $pdf->SetY(-50);
            $pdf->Image($footerPath, 10, '', 180);
        }
        $pdf->SetTitle('Reporte de Visitantes');
        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 11);
    
        $pdf->Cell(0, 10, 'Reporte de Visitantes', 0, 1, 'C');
        $pdf->Ln(5);
    
      
        foreach ($visitantes as $visitante) {
            
            $nombre = $visitante->nombre;
            $dui = $visitante->dui;
            $email = $visitante->email;
            $fechaNacimiento = $visitante->fecha_nacimiento;

  
            $generacion = $this->determinarGeneracion($fechaNacimiento);

            $pdf->Cell(0, 10, "Nombre: $nombre", 0, 1);
            $pdf->Cell(0, 10, "DUI: $dui", 0, 1);
            $pdf->Cell(0, 10, "Email: $email", 0, 1);
            $pdf->Cell(0, 10, "Fecha de Nacimiento: $fechaNacimiento", 0, 1);
            $pdf->Cell(0, 10, "Generación: $generacion", 0, 1);
            $pdf->Ln(5);
        }
    
        // Guardar el PDF
        $pdf->Output(storage_path('app/public/visitors_report.pdf'), 'F');
    
        $this->info('Reporte de visitantes generado exitosamente en storage/app/public/visitors_report.pdf');
    }
    

    private function determinarGeneracion($fechaNacimiento)
    {
        $anio = date('Y', strtotime($fechaNacimiento));

        if ($anio >= 1949 && $anio <= 1968) {
            return 'Baby boomers';
        } elseif ($anio >= 1969 && $anio <= 1980) {
            return 'Generación X';
        } elseif ($anio >= 1981 && $anio <= 1993) {
            return 'Millennials';
        } elseif ($anio >= 1994 && $anio <= 2010) {
            return 'Generación Z';
        } elseif ($anio >= 2010 && $anio <= date('Y')) {
            return 'Generación Alpha';
        } else {
            return 'Desconocido';
        }
    }
}
