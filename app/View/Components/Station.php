<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Station extends Component
{
    protected $stations = [
        'DEL' => 'Autorización',
        'GND' => 'Terrestre',
        'TWR' => 'Torre',
        'APP' => 'Aproximación',
        'CTR' => 'Centro',
    ];

    protected $airports = [
        'MMAA' => 'Acapulco',
        'MMAN' => 'Del Norte',
        'MMAS' => 'Aguascalientes',
        'MMBT' => 'Huatulco',
        'MMCB' => 'Cuernavaca',
        'MMCE' => 'Ciudad del Carmen',
        'MMCL' => 'Culiacán',
        'MMCM' => 'Chetumal',
        'MMCN' => 'Obregón',
        'MMCP' => 'Campeche',
        'MMCS' => 'Juárez',
        'MMCT' => 'Chichen Itzá',
        'MMCU' => 'Chihuahua',
        'MMCV' => 'Victoria',
        'MMCZ' => 'Cozumel',
        'MMDO' => 'Durango',
        'MMEP' => 'Tepic',
        'MMES' => 'Ensenada',
        'MMGL' => 'Guadalajara',
        'MMGM' => 'Guaymas',
        'MMHO' => 'Hermosillo',
        'MMIA' => 'Colima',
        'MMIO' => 'Saltillo',
        'MMLM' => 'Los Mochis',
        'MMLO' => 'León',
        'MMLP' => 'La Paz',
        'MMLT' => 'Loreto',
        'MMMA' => 'Matamoros',
        'MMMD' => 'Mérida',
        'MMML' => 'Mexicali',
        'MMMM' => 'Morelia',
        'MMMT' => 'Minatitlán',
        'MMMV' => 'Monclova',
        'MMMX' => 'México',
        'MMMY' => 'Monterrey',
        'MMMZ' => 'Mazatlán',
        'MMNL' => 'Nuevo Laredo',
        'MMOX' => 'Oaxaca',
        'MMPA' => 'Poza Rica',
        'MMPB' => 'Puebla',
        'MMPE' => 'Peñasco',
        'MMPG' => 'Piedras Negras',
        'MMPN' => 'Uruapan',
        'MMPQ' => 'Palenque',
        'MMPR' => 'Vallarta',
        'MMPS' => 'Escondido',
        'MMQT' => 'Querétaro',
        'MMRX' => 'Reynosa',
        'MMSD' => 'Cabos',
        'MMSL' => 'San Lucas',
        'MMSM' => 'Santa Lucía',
        'MMSP' => 'San Luis Potosí',
        'MMTC' => 'Torreón',
        'MMTG' => 'Tuxla Gutiérrez',
        'MMTJ' => 'Tijuana',
        'MMTM' => 'Tampico',
        'MMTN' => 'Tamuín',
        'MMTO' => 'Toluca',
        'MMTP' => 'Tapachula',
        'MMUN' => 'Cancún',
        'MMVA' => 'Villahermosa',
        'MMVR' => 'Veracruz',
        'MMZC' => 'Zacatecas',
        'MMZH' => 'Zihuatanejo',
        'MMZO' => 'Manzanillo',
        'MMID' => 'Mérida',
        'MMEX' => 'México',
        'MMZT' => 'Mazatlán',
        'MMTY' => 'Monterrey',
    ];

    public string $translation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $callsign)
    {
        // Get the parts
        $airport = substr($callsign, 0, 4);
        $station = substr($callsign, -3, 3);

        if (! array_key_exists($airport, $this->airports)) {
            $this->translation = 'No disponible';

            return;
        }

        if (! array_key_exists($station, $this->stations)) {
            $this->translation = 'No disponible';

            return;
        }

        $this->translation = $this->stations[$station].' '.$this->airports[$airport];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.station');
    }
}
