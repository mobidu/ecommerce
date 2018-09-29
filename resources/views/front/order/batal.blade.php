
<section class="content" style="margin-top: 20px;">
    <div class="row">

        <div class="col-md-12">
            <div class="box">
                <div class="box-header">

                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <h3>Daftar Transaksi Aktif</h3>
                        <div class="table-responsive" style="overflow: scroll; height: 400px">
                            <table class="table table-striped table-bordered" id="tabel-transaksi" >
                                <thead>
                                <tr>
                                    <th style="text-align: center">Invoice</th>
                                    <th style="text-align: center">Tanggal</th>
                                    <th style="text-align: center">Total</th>
                                    <th style="text-align: center">Status</th>
                                    <th width="25%" style="text-align: center">Opsi</th>
                                </tr>
                                </thead>
                                <tbody >
                                @forelse($list_order as $order)
                                    <tr>
                                        <td align="center">{{$order->invoice}}</td>
                                        <td align="center">{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                        <td align="center">Rp. {{number_format($order->order_detail()->sum('harga')+$order->jne)}},-</td>
                                        <td align="center">{!! $order->status_order == 'Batal' ? '<span class="label label-danger">Batal</span>' : ''!!}</td>
                                        <td align="center">
                                            <a href="{{url('/order/detail/'.$order->invoice)}}" class="btn btn-primary btn-sm"><span class="fa fa-file-text"></span>&nbsp;&nbsp;Detail</a>

                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->