<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FApprUmumPumk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION appr_umum_pumk (i_No text,i_UserId text)  
            RETURNS VOID AS ".'$body$'."
            DECLARE
            
            crH CURSOR FOR SELECT * from PUMK_HEADER where UPPER(No_PUMK)=UPPER(i_No);
            crD CURSOR FOR SELECT * from PUMK_DETAIL where UPPER(No_PUMK)=UPPER(i_No) Order By No;
            crUMK CURSOR(i_NoUmk text) FOR SELECT * from KERJA_DETAIL where upper(NO_UMK)=upper(i_NoUmk);
            v_Bagian varchar(10);
            v_DocNo varchar(20);
            v_No varchar(10);
            v_Udah boolean;
            v_Kepada varchar(35);
            vNomorBukti varchar(6);
            v_id varchar(4);
            v_Tahun varchar(2);
            v_Bulan varchar(2);
            v_NILTOT bigint;
            v_NILTOTKAS bigint;
            v_TotPUMK bigint;
            v_TotUMK bigint;
            v_NomorUMK varchar(25);
            v_Selisihnya bigint;
            V_NoVer varchar(6);
            v_BlnBuku varchar(6);
            
            BEGIN
                v_Bagian:='D0000';
                Select thnblnopen() into v_BlnBuku ;
                SELECT SUM(NILAI) INTO v_TotPUMK FROM PUMK_DETAIL where UPPER(NO_PUMK)=UPPER(i_No);
                Select NO_UMK INTO v_NomorUMK from PUMK_HEADER where UPPER(No_PUMK)=UPPER(i_No);
                SELECT SUM(JUMLAH) INTO v_TotUMK FROM KERJA_HEADER where UPPER(NO_UMK)=UPPER(v_NomorUMK);
                v_Selisihnya := v_TotUMK - v_TotPUMK;
                if v_Selisihnya >= 0 then
                For t in crH loop
                    -- Nomor Kas
                    Select Max(substring(DocNo from 13)) into v_No from Kasdoc Where DocNo Like 'M/' || v_Bagian || '/' || substring(v_BlnBuku from 3 for 2) || substring(v_BlnBuku from 5 for 2) || '%';
                    v_No    := lpad((coalesce(CAST(v_No AS integer), 0)+1)::text, 3, '0');
                    v_DocNo := 'M/' || v_Bagian || '/' || substring(v_BlnBuku from 3 for 2) || substring(v_BlnBuku from 5 for 2) || v_No;
                    -- Nomor Bukti
                    -- UMK store 10
                    Select coalesce(Ltrim(To_Char(cast(Max(Voucher) AS integer)+1,'0000')),'0001') into vNomorBukti  
                    from Kasdoc 
                    where 
                        substring(thnbln from 1 for 4)=substring(v_BlnBuku from 1 for 4) 
                        and store='10' 
                        and substring(docno from 1 for 4)='M';
                    Select SUM(NILAI) INTO v_NILTOT from PUMK_DETAIL where UPPER(No_PUMK)=UPPER(i_No);
                    -- Masukkan ke header Kas
                    INSERT INTO KASDOC(DOCNO,THNBLN,JK,STORE,CI,VOUCHER,KEPADA,DEBET,KREDIT,ORIGINAL,ORIGINALDATE,VERIFIED,PAID,POSTED,INPUTDATE,INPUTPWD,RATE,NILAI_DOK,KD_KEPADA,ORIGINALBY,KET1,KET2,REF_NO)VALUES(v_DocNo,v_BlnBuku,'10','10','1',vNomorBukti,'SDR.ANGGRAINI GITTA LESTARI',0,0,'Y',LOCALTIMESTAMP,'N','N','N',LOCALTIMESTAMP,i_UserId,'1',v_NILTOT,'PJUMK',i_UserId,'PJUMK'||' '||i_No,'(Terlampir)',i_No);
                    for i in crUMK(t.NO_UMK) loop
                        Insert into Kasline(docno,lineno,account,bagian,pk,jb,cj,keterangan,penutup,totprice,lokasi)
                                    values(v_DocNo,pbd_carilineno(v_DocNo),i.account,i.bagian,'000000',i.jb,i.cj,'TK.UMK'||i.keterangan,'N',i.NILAI * -1,'MS');
                    End loop;
                    for d in crD loop
                        Insert into KasLine(docno,lineno,account,bagian,pk,jb,cj,keterangan,penutup,totprice,lokasi)
                                            values(v_DocNo,pbd_carilineno(v_DocNo),d.account,D.bagian,D.pk,D.jb,d.cj,d.keterangan,'N',d.nilai,'MS');
                    end loop;
                    Update PUMK_HEADER Set 
                    NO_KAS = v_Docno,
                    APP_SDM='Y',
                    APP_SDM_OLEH=i_UserId,
                    APP_SDM_TGL=LOCALTIMESTAMP,
                    APP_PBD='N' 
                    Where UPPER(NO_PUMK)=UPPER(i_No);
                    Select SUM(totprice) INTO v_NILTOTKAS from KASLINE where UPPER(DOCNO)=UPPER(v_DocNo);
                    UPDATE KASDOC SET NILAI_DOK=v_NILTOTKAS WHERE UPPER(DOCNO)=UPPER(v_DocNo);
                end loop;
                Elsif v_Selisihnya < 0 then
                For t in crH loop
                    -- Nomor Kas
                    Select Max(substring(DocNo from 13)) into v_No from Kasdoc Where DocNo Like 'P/' || v_Bagian || '/' || substring(v_BlnBuku from 3 for 2) || substring(v_BlnBuku from 5 for 2) || '%';
                    v_No     := lpad((coalesce(CAST(v_No AS integer), 0)+1)::text, 3, '0');
                    v_DocNo := 'P/' || v_Bagian || '/' || substring(v_BlnBuku from 3 for 2) || substring(v_BlnBuku from 5 for 2) || v_No;
                    -- Nomor Bukti
                    -- UMK store 10
                    Select coalesce(Ltrim(To_Char(cast(Max(Voucher) AS integer)+1,'0000')),'0001') into vNomorBukti 
                    from Kasdoc 
                    where 
                        substring(thnbln from 1 for 4)=substring(v_BlnBuku from 1 for 4) 
                        and store='10' 
                        and substring(docno from 1 for 1)='P';
                    Select SUM(NILAI) INTO v_NILTOT from PUMK_DETAIL where UPPER(No_PUMK)=UPPER(i_No);
                    -- No Verifikasi
                    Select Lpad(coalesce(Max(left(mrs_no,4)),'0') +1,4,'0') into V_NoVer  
                    from Kasdoc 
                    Where 
                        substring(thnbln from 1 for 4)=substring(v_BlnBuku from 1 for 4) 
                        and substring(docno from 1 for 4)='P';
                    -- Masukkan ke header Kas
                    INSERT INTO KASDOC(DOCNO,THNBLN,JK,STORE,CI,VOUCHER,KEPADA,DEBET,KREDIT,ORIGINAL,ORIGINALDATE,VERIFIED,PAID,POSTED,INPUTDATE,INPUTPWD,RATE,NILAI_DOK,KD_KEPADA,ORIGINALBY,KET1,KET2,REF_NO,MRS_NO)VALUES(v_DocNo,v_BlnBuku,'10','10','1',vNomorBukti,'SDR. BAMBANG',0,0,'Y',LOCALTIMESTAMP,'N','N','N',LOCALTIMESTAMP,i_UserId,'1',v_NILTOT,'PJUMK',i_UserId,'PJUMK'||' '||i_No,'(Terlampir)',i_No,V_NoVer);
                    for i in crUMK(t.NO_UMK) loop
                        Insert into Kasline(docno,lineno,account,bagian,pk,jb,cj,keterangan,penutup,totprice,lokasi)
                                    values(v_DocNo,pbd_carilineno(v_DocNo),i.account,i.bagian,'000000',i.jb,i.cj,'TK.UMK'||i.keterangan,'N',i.NILAI * -1,'MS');
                    End loop;
                    for d in crD loop
                        Insert into KasLine(docno,lineno,account,bagian,pk,jb,cj,keterangan,penutup,totprice,lokasi)
                                            values(v_DocNo,pbd_carilineno(v_DocNo),d.account,D.bagian,D.pk,D.jb,d.cj,d.keterangan,'N',d.nilai,'MS');
                    end loop;
                    Update PUMK_HEADER Set 
                    NO_KAS = v_Docno,
                    APP_SDM='Y',
                    APP_SDM_OLEH=i_UserId,
                    APP_SDM_TGL=LOCALTIMESTAMP,
                    APP_PBD='N' 
                    Where UPPER(NO_PUMK)=UPPER(i_No);
                    Select SUM(totprice) INTO v_NILTOTKAS from KASLINE where UPPER(DOCNO)=UPPER(v_DocNo);
                    UPDATE KASDOC SET NILAI_DOK=v_NILTOTKAS WHERE UPPER(DOCNO)=UPPER(v_DocNo);
                end loop;
                End if;
            end;
            ".'$body$'."
            LANGUAGE PLPGSQL
            ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION appr_umum_pumk");
    }
}
