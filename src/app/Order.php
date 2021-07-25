<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public const STATUS_NEW = 0;
    public const STATUS_CONFIRMED = 10;
    public const STATUS_COMPLETE = 20;

    protected $fillable = ['client_email', 'partner_id', 'status'];

    public function getPartner() : Partner
    {
        return Partner::query()->where('id', $this->getAttribute('partner_id'))->get()->first();
    }

    public function getProducts() : array
    {
        return OrderProduct::query()
            ->addSelect([DB::raw('products.name'), 'quantity'])
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->where('order_id', $this->getAttribute('id'))
            ->get()
            ->all();
    }

    public function getTotal()
    {
        return OrderProduct::query()
            ->addSelect(DB::raw('SUM(quantity * price) AS total'))
            ->where('order_id', $this->getAttribute('id'))
            ->orderBy('order_id')
            ->groupBy('order_id')
            ->get()
            ->first()
            ->getAttribute('total');
    }

    public function getStatus() : string
    {
        return $this->getStatusMap()[$this->getAttribute('status')] ?? '';
    }

    public function getStatusMap() : array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_COMPLETE => 'Complete'
        ];
    }
}
