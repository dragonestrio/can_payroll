<?php

namespace App\Exports;

use App\Models\Financial;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FinancialExport implements FromCollection, WithHeadings, WithColumnWidths, WithCustomStartCell, WithStyles, WithTitle, WithProperties
{
    use Exportable;

    public function __construct($data = null, $title = null)
    {
        $export = [];
        ($data != null) ?: $data = Financial::get();

        $no = 1;
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value->price;
            array_push($export, [
                'no'            => $no++,
                'name'          => ucwords($value->name),
                'type'          => ucwords($value->type),
                'price'         => $value->price,
                'description'   => ucwords($value->description),
                'created_at'    => date('d M Y', strtotime($value->created_at)),
                'status'        => ($value->deleted_at == null) ? 'v' : 'x',
            ]);
        }

        array_push($export, [
            'no'            => '',
            'name'          => ucwords('jumlah'),
            'type'          => '',
            'price'         => '',
            'description'   => '',
            'created_at'    => $total,
            'status'        => '',
        ]);

        // main data
        $this->title = ucwords($title);
        $this->data = $export;
        $this->last_row = count($export) + 1;
        $this->last_no = $no;
        //
    }

    public function headings(): array
    {
        return [
            ucwords('No'),
            ucwords('Nama transaksi'),
            ucwords('Tipe transaksi'),
            ucwords('Nominal'),
            ucwords('Catatan'),
            ucwords('Tanggal transaksi'),
            ucwords('Status'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 25,
            'F' => 18,
            'G' => 7,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1   => [
                'font'  => ['bold' => true, 'color' => ['argb' => 'ffffff']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => '6c757d']],
            ],
            $this->last_row   => [
                'font'  => ['bold' => true, 'color' => ['argb' => 'ffffff']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => '6c757d']],
            ],
            'A'   => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            'C'   => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            'D'   => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            'F'   => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            'G'   => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function title(): string
    {
        return ucwords('data ' . $this->title);
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Satrio Nugroho',
            'lastModifiedBy' => 'Satrio Nugroho',
            'title'          => ucwords($this->title . ' Export'),
            'description'    => ucwords('Latest ' . $this->title),
            'subject'        => $this->title,
            'keywords'       => strtolower($this->title) . ',export,spreadsheet',
            'category'       => $this->title,
            'manager'        => '',
            'company'        => 'CAN Creative',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection($this->data);
    }
}
