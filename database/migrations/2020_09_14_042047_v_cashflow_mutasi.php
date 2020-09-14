<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCashflowMutasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW v_cashflow_mutasi AS
        -- Penerimaan Dividen, 414100, 1301xx-1306xx
        select '1' as status,'1' as urutan,'Penerimaan Dividen' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT = '414100'
        GROUP BY B.THNBLN

        union all
        select '1' as status,'1' as urutan,'Penerimaan Dividen' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT BETWEEN '1301%' AND '1306%'
        GROUP BY B.THNBLN

        -- Penerimaan Bunga Deposito, 400xxx dikurangi 480xxx
        union all
        select '1' as status,'2' as urutan,'Penerimaan Bunga Deposito' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '400%'
        GROUP BY B.THNBLN

        union all
        select '1' as status,'2' as urutan,'Penerimaan Bunga Deposito' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '480%'
        GROUP BY B.THNBLN

        -- Penerimaan Hasil Investasi Lainnya, 4173xx
        union all
        select '1' as status,'3' as urutan,'Penerimaan Hasil Investasi Lainnya' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '4173%'
        GROUP BY B.THNBLN

        -- Penerimaan Currency Swap, 517347 (Kredit)
        union all
        select '1' as status,'4' as urutan,'Penerimaan Currency Swap' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT = '517347'
        AND A.TOTPRICE < 0
        GROUP BY B.THNBLN

        -- Pengembalian Piutang Lainnya, 1261xx-1263xx, 1280xx-1288xx, 103xxx
        union all
        select '1' as status,'5' as urutan,'Pengembalian Piutang Lainnya' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT BETWEEN '1261%' AND '1263%'
        GROUP BY B.THNBLN

        union all
        select '1' as status,'5' as urutan,'Pengembalian Piutang Lainnya' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT BETWEEN '1280%' AND '1288%'
        GROUP BY B.THNBLN

        union all
        select '1' as status,'5' as urutan,'Pengembalian Piutang Lainnya' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '103%'
        GROUP BY B.THNBLN

        -- Pembayaran Kepada Karyawan, 50xxxx
        union all
        select '1' as status,'6' as urutan,'Pembayaran Kepada Karyawan' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '50%'
        GROUP BY B.THNBLN

        -- Pembayaran Kepada Pemasok, 51xxxx, 56xxxx
        union all
        select '1' as status,'7' as urutan,'Pembayaran Kepada Pemasok' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '51%'
        GROUP BY B.THNBLN

        union all
        select '1' as status,'7' as urutan,'Pembayaran Kepada Pemasok' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '56%'
        GROUP BY B.THNBLN

        -- Pembayaran Pajak Penghasilan, 206xxx, 420002, 106309
        union all
        select '1' as status,'8' as urutan,'Pembayaran Pajak Penghasilan' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT IN ('420002', '106309')
        GROUP BY B.THNBLN

        union all
        select '1' as status,'8' as urutan,'Pembayaran Pajak Penghasilan' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO 
        AND A.ACCOUNT LIKE '206%'
        GROUP BY B.THNBLN


        -- Penerimaan (Penempatan) Deposito, 110xxx
        union all
        select '1' as status,'9' as urutan,'Penerimaan (Penempatan) Deposito' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '110%'
        GROUP BY B.THNBLN

        -- Pengeluran Currency Swap, 517347 (Debet)
        union all
        select '1' as status,'10' as urutan,'Pengeluran Currency Swap' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT = '517347'
        AND A.TOTPRICE > 0
        GROUP BY B.THNBLN

        -- Penerimaan (pembayaran) Operasional lainnya, Seluruh Account selain yang sudah ditentukan
        -- union all
        -- select '2' as status,'11' as urutan,'Penyertaan Saham' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '124%'
        -- AND A.TOTPRICE > 0

        -- Penyertaan Saham, 124xxx (Debet)
        union all
        select '2' as status,'1' as urutan,'Penyertaan Saham' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '124%'
        AND A.TOTPRICE > 0
        GROUP BY B.THNBLN

        -- Penjualan Saham, 124xxx (Kredit)
        union all
        select '2' as status,'2' as urutan,'Penjualan Saham' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '124%'
        AND A.TOTPRICE < 0
        GROUP BY B.THNBLN

        -- Pembelian Asset Tetap, 003xxx (Debet)
        union all
        select '2' as status,'3' as urutan,'Pembelian Asset Tetap' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '003%'
        AND A.TOTPRICE > 0
        GROUP BY B.THNBLN

        -- Penjualan Asset Tetap, 003xxx (Kredit)
        union all
        select '2' as status,'4' as urutan,'Penjualan Asset Tetap' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '003%'
        AND A.TOTPRICE < 0
        GROUP BY B.THNBLN

        -- Pembayaran Dividen, 208000, 208005
        union all
        select '3' as status,'1' as urutan,'Pembayaran Dividen' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT in ('208000','208005')
        GROUP BY B.THNBLN

        -- Pemberian Shareholder Loan, 1307xx (Debet)
        union all
        select '3' as status,'2' as urutan,'Pemberian Shareholder Loan' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '1307%'
        AND A.TOTPRICE > 0
        GROUP BY B.THNBLN

        -- Pengembalian Shareholder Loan, 1307xx (Kredit)
        union all
        select '3' as status,'3' as urutan,'Pengembalian Shareholder Loan' as Jenis,substring(B.THNBLN from 1 for 4) AS TAHUN,substring(B.THNBLN from 5 for 2) AS BULAN, SUM(round(A.TOTPRICE*B.Rate)) as totpricerp from kasline A,KASDOC B where A.keterangan <> 'PENUTUP' AND B.DOCNO=A.DOCNO AND A.ACCOUNT like '1307%'
        AND A.TOTPRICE > 0
        GROUP BY B.THNBLN

        ORDER BY status ASC, urutan ASC, tahun DESC, bulan DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_cashflow_mutasi");
    }
}
