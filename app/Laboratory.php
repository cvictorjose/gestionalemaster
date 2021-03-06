<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;


class Laboratory extends Model
{
    protected $table = 'laboratory';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icar_code','lab_name','status',
        'nominativo_contatto',
        'email',
        'spedizione_address',
        'spedizione_cap',
        'spedizione_city',
        'spedizione_country',
        'ente_associato','',
        'contatto_amministrativo',
        'email_amministrativa',
        'invoice_address',
        'invoice_cap',
        'invoice_city',
        'invoice_country',
        'invoicetype',
        'vat_number',
        'participation_fee',
        'shipment_cost',
        'fat_ref',
        'protein_ref','lactose_ref','urea_ref','scc_ref',
        'fat_rout','protein_rout','lactose_rout','urea_rout',
        'bhb','pag','dna'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Check username user and return true or false.
     *
     * @return mixed
     */


    protected function checkCodeLab($code){
        try {
            return Laboratory::where('icar_code', $code)->get()->isNotEmpty();
        } catch (Exception $e) {
            return false;
        }
    }

}
