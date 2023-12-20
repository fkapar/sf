<?php
//require 'vendor/autoload.php';
//$api_key = 'AIzaSyCshrrPM0CJ3KFIdqBQ00GYVQhTy3ExvH0'; // Deneme api_key'i

$SQL_kanal_genel_bilgiler = <<<SQL
	SELECT
		*
	FROM
		tb_y_kanallar
	WHERE
		kanal_id = ?
SQL;


$SQL_kanal_varmi = <<<SQL
	SELECT
		 kanal_id
	FROM
		tb_y_kanallar
	WHERE
		kanal_kullanici_adi = ?
SQL;


$SQL_kullanici_aramalari_ekle = <<< SQL
	INSERT INTO
		tb_kullanici_aramalari
	SET
		adi = ?
SQL;


$SQL_kategoriler = <<<SQL
	SELECT
		*
	FROM
		tb_y_kategoriler
SQL;


$SQL_ulkeler = <<<SQL
	SELECT
		*
	FROM
		tb_y_ulkeler
SQL;


// Chart sorguları
$SQL_chart_izlenme_sayisi = <<<SQL
	SELECT
		 tarih
		,izlenme_sayisi
	FROM
		tb_y_yillik_sayisal_veriler
	WHERE
		k_id = ?
	ORDER BY tarih
SQL;

$SQL_chart_takipci_sayisi = <<<SQL
	SELECT
		 tarih
		,takipci_sayisi
	FROM
		tb_y_yillik_sayisal_veriler
	WHERE
		k_id = ?
	ORDER BY tarih
SQL;


// Değişim Sorguları
$SQL_izlenme_degisim = <<<SQL
	SELECT
		 tarih
		,takipci_sayisi
		,takipci_degisim
	FROM
		tb_y_yillik_sayisal_veriler
	WHERE
		k_id = ?
	ORDER BY tarih DESC
	LIMIT 1
SQL;


// Değişim Sorguları
$SQL_izlenme_takipci_kazanc = <<<SQL
	SELECT
		 s.izlenme_degisim
		,ROUND( s.izlenme_degisim * 100 / (s.izlenme_sayisi - s.izlenme_degisim) ) AS izlenme_yuzde
		,takipci_degisim
		,ROUND( s.takipci_degisim * 100 / (s.takipci_sayisi- s.takipci_degisim) ) AS takipci_yuzde
		,k.cpm1 * s.izlenme_sayisi AS kazanc_min
		,k.cpm2 * s.izlenme_sayisi AS kazanc_max
	FROM
		tb_y_yillik_sayisal_veriler s
	LEFT JOIN
		tb_y_kanallar as k ON s.k_id = k.kanal_id
	WHERE
		s.k_id = ?
	ORDER BY s.tarih DESC LIMIT 1
SQL;


// Yıllık kazanç
$SQL_yillik_kazanc = <<<SQL
	SELECT
		 sum( k.cpm1 * s.izlenme_sayisi ) AS kazanc_min
		,sum( k.cpm2 * s.izlenme_sayisi ) AS kazanc_max
	FROM
		tb_y_yillik_sayisal_veriler s
	LEFT JOIN
		tb_y_kanallar as k ON s.k_id = k.kanal_id
	WHERE
		s.k_id = ?
SQL;


// Total grade
$SQL_total_grade = <<<SQL
	SELECT
		ROUND( ( puan / ( SELECT MAX(puan) FROM tb_y_yillik_sayisal_veriler ) ) * 100 ) AS puan
	FROM
		tb_y_yillik_sayisal_veriler
	WHERE
		k_id = ?
	LIMIT 1
SQL;



/*
	**** Rank Sorguları ****
*/
// Video izlenme sırası
$SQL_video_izlenme_sira_yuzde = <<<SQL
SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
	SELECT
		 kanal_id, (@row_number := @row_number + 1) as sira
		,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
	FROM
		tb_y_kanallar
	ORDER BY izlenme_sayisi DESC
) as sonuc
WHERE
	sonuc.kanal_id = ?
SQL;


// Takipçi sırası
$SQL_takipci_sira_yuzde = <<<SQL
	SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
		SELECT
			 kanal_id, (@row_number := @row_number + 1) as sira
			,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
		FROM
			tb_y_kanallar
		ORDER BY takipci_sayisi DESC
	) as sonuc
	WHERE
		sonuc.kanal_id = ?
SQL;


// social fern 
$SQL_sf_sira_yuzde = <<<SQL
SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
	SELECT
		 kanal_id,( izlenme_sayisi+takipci_sayisi + 0 ) as toplam_puan, (@row_number := @row_number + 1) as sira
		,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
	FROM
		tb_y_kanallar
	ORDER BY toplam_puan DESC
) AS sonuc
WHERE
	sonuc.kanal_id = ?
SQL;

// Ulke  
$SQL_ulke_sira_yuzde = <<<SQL
SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
	SELECT
		 kanal_id, ulke_id,( izlenme_sayisi+takipci_sayisi+0 ) as toplam_puan, (@row_number := @row_number + 1) as sira
		,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
	FROM
		tb_y_kanallar WHERE ulke_id = ?
	ORDER BY toplam_puan DESC
) AS sonuc
WHERE
	sonuc.kanal_id = ?
SQL;

// Kategori  
$SQL_kategori_sira_yuzde = <<<SQL
SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
	SELECT
		 kanal_id, kategori_id,( izlenme_sayisi+takipci_sayisi + 0 ) as toplam_puan, (@row_number := @row_number + 1) as sira
		,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
	FROM
		tb_y_kanallar WHERE kategori_id = ?
	ORDER BY toplam_puan DESC
) AS sonuc
WHERE
	sonuc.kanal_id = ?
SQL;

// Mementum  
$SQL_momentum_sira_yuzde = <<<SQL
SELECT sonuc.sira, ( ( sonuc.kayit_sayisi - sonuc.sira ) * 100 ) / sonuc.kayit_sayisi AS yuzde  FROM(
		SELECT
			 kanal_id,( takipci_sayisi/DATEDIFF(NOW(),kayit_tarihi)) as momentum, (@row_number := @row_number + 1) as sira
			,( SELECT COUNT(*) FROM tb_y_kanallar ) as kayit_sayisi
		FROM
			tb_y_kanallar
		ORDER BY momentum DESC
	) AS sonuc
WHERE
	sonuc.kanal_id = ?
SQL;

/*************/
$SQL_yillik_veriler = <<<SQL
	SELECT
		 s.tarih
		,s.izlenme_sayisi
		,s.takipci_sayisi
	FROM
		tb_y_kanallar as k
	LEFT JOIN
		tb_y_yillik_sayisal_veriler AS s ON k.kanal_id = s.k_id
	WHERE
		k.kanal_id = ?
	ORDER BY tarih DESC
SQL;


$SQL_izlenme_top10_kanallari = <<< SQL
SELECT
	 kanal_adi
	,video_sayisi
	,takipci_sayisi
	,izlenme_sayisi
	,profil_resim
	,kanal_kullanici_adi
FROM
tb_y_kanallar
ORDER BY
	izlenme_sayisi DESC
LIMIT
	10
SQL;


$SQL_takipci_top10_kanallari = <<< SQL
SELECT
	 kanal_adi
	,video_sayisi
	,takipci_sayisi
	,izlenme_sayisi
	,profil_resim
	,kanal_kullanici_adi
FROM
tb_y_kanallar
ORDER BY
	takipci_sayisi DESC
LIMIT
	10
SQL;


$SQL_ulke_id = <<< SQL
	SELECT id FROM tb_y_ulkeler WHERE adi_kisa = ?
SQL;

$puanHarfRenk = array(
	 "on"		=> array( "harf" => "C-",	"renk" => "#dc3545" )
	,"yirmi"	=> array( "harf" => "C",	"renk" => "#dc3545" )
	,"otuz"		=> array( "harf" => "C+",	"renk" => "#dc3545" )
	,"kirk"		=> array( "harf" => "B-",	"renk" => "#ff851b" )
	,"elli"		=> array( "harf" => "B",	"renk" => "#ff851b" )
	,"altmis"	=> array( "harf" => "B+",	"renk" => "#ff851b" )
	,"yetmis"	=> array( "harf" => "A-",	"renk" => "#28a745" )
	,"seksen"	=> array( "harf" => "A",	"renk" => "#28a745" )
	,"doksan"	=> array( "harf" => "A+",	"renk" => "#28a745" )
	,"yuz"		=> array( "harf" => "A++",	"renk" => "#3c8dbc" )
);

function DB() {
	// Social fern sunucu
	$host		= "localhost";
    $dbname		= "xpinxyz_socialfern2023";
    $username	= "xpinxyz_fern_user";
    $password	= "Frt.2023_KPR1?Van.";
	
/*	
	$host		= "localhost";
    $dbname		= "socialfern2023";
    $username	= "root";
    $password	= "";
*/
    try {
        $pdo = new PDO( "mysql:host=$host;dbname=$dbname", $username, $password );
        return $pdo;
    } catch ( PDOException $e ) {
        die( "Db connection is failed: " . $e->getMessage() );
    }
}


function puanHarfiVer( $sayi ) {
	$puanlar = [
		 10		=> "on"
		,20		=> "yirmi"
		,30		=> "otuz"
		,40		=> "kirk"
		,50		=> "elli"
		,60		=> "altmis"
		,70		=> "yetmis"
		,80		=> "seksen"
		,90		=> "doksan"
		,100	=> "yuz"
	];

	foreach ( $puanlar as $aralik => $deger ) {
		if ( $sayi <= $aralik ) {
			return $deger;
		}
	}
}


function kanalIdVer( $kullanici_adi ) {
	global $SQL_kanal_varmi;
	global $SQL_kullanici_aramalari_ekle;
	
	// Eğer "@" işareti yoksa, ekle
	if ( substr( $kullanici_adi, 0, 1 ) !== '@' ) {
		$kullanici_adi = '@' . $kullanici_adi;
	}

	$vt = DB();
	$sorguHazir = $vt->prepare( $SQL_kanal_varmi );
	$sorguHazir->execute( array( $kullanici_adi ) );

	$sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
	if ( $sonuc ) {
		return $sonuc;
	} else {
		$sorguHazir = $vt->prepare( $SQL_kullanici_aramalari_ekle );
		$sorguHazir->execute( array( $kullanici_adi ) );
		return false;
	}
	$vt = null;
}


function top10ListesiVer() {
	global $SQL_izlenme_top10_kanallari;
	global $SQL_takipci_top10_kanallari;
	
	$vt = DB();
	// İzlenme top 10
	$sorguHazir = $vt->prepare( $SQL_izlenme_top10_kanallari );
	$sorguHazir->execute(array());
	$izlenme_sayisi_top10_sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );	
	
	// Takipçi top 10
	$sorguHazir = $vt->prepare( $SQL_takipci_top10_kanallari );
	$sorguHazir->execute(array());
	$takipci_sayisi_top10_sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );
	
	foreach( $izlenme_sayisi_top10_sonuc as &$kayit ) {
		$kayit[ "izlenme_sayisi" ]	= sayiFormati( $kayit[ "izlenme_sayisi" ] );
		$kayit[ "video_sayisi" ]	= sayiFormati( $kayit[ "video_sayisi" ] );
		$kayit[ "takipci_sayisi" ]	= sayiFormati( $kayit[ "takipci_sayisi" ] );
	}
	
	foreach( $takipci_sayisi_top10_sonuc as &$kayit ) {
		$kayit[ "izlenme_sayisi" ]	= sayiFormati( $kayit[ "izlenme_sayisi" ] );
		$kayit[ "video_sayisi" ]	= sayiFormati( $kayit[ "video_sayisi" ] );
		$kayit[ "takipci_sayisi" ]	= sayiFormati( $kayit[ "takipci_sayisi" ] );
	}

	return array( "takipci" => $takipci_sayisi_top10_sonuc, "izlenme" => $izlenme_sayisi_top10_sonuc );
}


function kanalBilgiVer( $kullanici_adi ) {
	global $puanHarfRenk;
	global $SQL_kanal_genel_bilgiler;
	global $SQL_sf_sira_yuzde;
	global $SQL_video_izlenme_sira_yuzde;
	global $SQL_takipci_sira_yuzde;
	global $SQL_ulke_sira_yuzde;
	global $SQL_kategori_sira_yuzde;
	global $SQL_momentum_sira_yuzde;
	global $SQL_yillik_veriler;
	
	global $SQL_chart_izlenme_sayisi;
	global $SQL_chart_takipci_sayisi;
	global $SQL_izlenme_takipci_kazanc;
	global $SQL_yillik_kazanc;
	global $SQL_total_grade;

	$sonuc			= kanalIdVer( $kullanici_adi );
	$ulkeler		= ulkeler();
	$kategoriler	= kategoriler();

	if( $sonuc ) {
		$kanal_id = $sonuc[ "kanal_id" ];

		$vt = DB();
		$sorguHazir = $vt->prepare( $SQL_kanal_genel_bilgiler );
		$sorguHazir->execute( array( $kanal_id ) );
		$sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// kanalın ülke adının kısa formatını kanal genel bilgiler dizisine ekle
		foreach( $ulkeler AS $u ) {
			if( $u[ "id" ] == $sonuc[ "ulke_id" ] ) {
				$sonuc[ "ulke_bayrak" ] = strtolower( $u[ "adi_kisa" ] . ".png" );
				$sonuc[ "ulke_adi_kisa" ] = $u[ "adi_kisa" ];
				break;
			}
		}
		
		// Kategori adını diziye ekler
		foreach( $kategoriler AS $k ) {
			if( $k[ "id" ] == $sonuc[ "kategori_id" ] ) {
				$sonuc[ "kategori_adi" ] = $k[ "adi" ];
				break;
			}
		}

		// Sf Sira yuzde bul
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_sf_sira_yuzde );
		$sorguHazir->execute( array( $kanal_id ) );
		$sf_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		
		// Video izlenme Sira yuzde bul
		$vt->query( 'SET @row_number = 0' );
		$sorguHazir = $vt->prepare( $SQL_video_izlenme_sira_yuzde );
		$sorguHazir->execute( array( $kanal_id ) );
		$izlenme_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// Takipçi Sira yuzde bul
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_takipci_sira_yuzde );
		$sorguHazir->execute( array( $kanal_id ) );
		$takipci_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// Ulke Sira yuzde bul
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_ulke_sira_yuzde );
		$sorguHazir->execute( array( $sonuc[ "ulke_id" ], $kanal_id ) );
		$ulke_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// Kategori Sira yuzde bul
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_kategori_sira_yuzde );
		$sorguHazir->execute( array( $sonuc[ "kategori_id" ], $kanal_id ) );
		$kategori_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// Momentum Sira yuzde bul
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_momentum_sira_yuzde );
		$sorguHazir->execute( array( $kanal_id ) );
		$momentum_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// izlenme takipçi ve kazanç
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_izlenme_takipci_kazanc );
		$sorguHazir->execute( array($kanal_id ) );
		$izlenme_takipci_kazanc_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// yıllık kazanç
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_yillik_kazanc );
		$sorguHazir->execute( array( $kanal_id ) );
		$yillik_kazanc_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
		
		// Total grade
		$vt->query('SET @row_number = 0');
		$sorguHazir = $vt->prepare( $SQL_total_grade );
		$sorguHazir->execute( array( $kanal_id ) );
		$total_grade_sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );


		$sonuc["sf_sira"] = sayiSiraFormati( $sf_sonuc[ "sira" ] );
		$sonuc["sf_yuzde"] = $sf_sonuc[ "sira" ] == 1 ? 100 : $sf_sonuc[ "yuzde" ];

		$sonuc["izlenme_sira"] = sayiSiraFormati( $izlenme_sonuc[ "sira" ] );
		$sonuc["izlenme_yuzde"] = $izlenme_sonuc[ "sira" ] == 1 ? 100 : $izlenme_sonuc[ "yuzde" ];

		$sonuc["takipci_sira"] = sayiSiraFormati( $takipci_sonuc[ "sira" ] );
		$sonuc["takipci_yuzde"] = $takipci_sonuc[ "sira" ] == 1 ? 100 : $takipci_sonuc[ "yuzde" ];

		$sonuc["momentum_sira"] = sayiSiraFormati( $momentum_sonuc[ "sira" ] );
		$sonuc["momentum_yuzde"] = $momentum_sonuc[ "sira" ] == 1 ? 100 : $momentum_sonuc[ "yuzde" ];
		
		
		$sonuc["ulke_sira"] = $sonuc[ "ulke_id" ] > 0 ? sayiSiraFormati( $ulke_sonuc[ "sira" ] ) : "--";
		$sonuc["ulke_yuzde"] = $sonuc[ "ulke_id" ] > 0 ? ( $ulke_sonuc[ "sira" ] == 1 ? 100 : $ulke_sonuc[ "yuzde" ] ) : 0;
		
		$sonuc["kategori_sira"] = $sonuc[ "kategori_id" ] > 0 ? sayiSiraFormati( $kategori_sonuc[ "sira" ] ) : "--";
		$sonuc["kategori_yuzde"] = $sonuc[ "kategori_id" ] > 0 ? ( $kategori_sonuc[ "sira" ] == 1 ? 100 : $kategori_sonuc[ "yuzde" ] ) : 0;
		
		
		//Geçici bir puan verelim
		$puan = $total_grade_sonuc[ "puan" ];
		$sonuc["toplam_puan_harf"] = $puanHarfRenk[ puanHarfiVer( $puan ) ][ "harf" ];
		$sonuc["toplam_puan_renk"] = $puanHarfRenk[ puanHarfiVer( $puan ) ][ "renk" ];
		
		
		// İzlenme chart
		$sorguHazir = $vt->prepare( $SQL_chart_izlenme_sayisi );
		$sorguHazir->execute( array( $kanal_id ) );
		$chart_izlenme_sayisi_sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );
		
		
		$chart_etiket = array();
		$chart_izlenme = array();
		foreach( $chart_izlenme_sayisi_sonuc as $izlenme ) {
			$chart_etiket[]  = tarihFormatiDuzeltAyYil( $izlenme[ "tarih" ] );
			$chart_izlenme[] = $izlenme[ "izlenme_sayisi" ];
		}
		$sonuc[ "chart_etiket_izlenme" ] = $chart_etiket;
		$sonuc[ "chart_izlenme" ] = $chart_izlenme;
				
		
		// Yıllık veriler
		$sorguHazir = $vt->prepare( $SQL_yillik_veriler );
		$sorguHazir->execute( array( $kanal_id ) );
		$yillik_veriler_sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );		
		
		// Takipçi chart
		$sorguHazir = $vt->prepare( $SQL_chart_takipci_sayisi );
		$sorguHazir->execute( array( $kanal_id ) );
		$chart_takipci_sayisi_sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );
		
		
		$chart_etiket = array();
		$chart_takipci = array();
		foreach( $chart_takipci_sayisi_sonuc as $takipci ) {
			$chart_etiket[]  = tarihFormatiDuzeltAyYil( $takipci[ "tarih" ] );
			$chart_takipci[] = $takipci[ "takipci_sayisi" ];
		}
		$sonuc[ "chart_etiket_takipci_sayisi" ]	= $chart_etiket;
		$sonuc[ "chart_takipci_sayisi" ]		= $chart_takipci;
		
		
		
		
		// Aylık değişimler ve kazançlar
		$izlenme_yuzde		= $izlenme_takipci_kazanc_sonuc['izlenme_yuzde'];
		$takipci_yuzde		= $izlenme_takipci_kazanc_sonuc['takipci_yuzde'];
		
		$takipci_degisim		= sayiFormati( $izlenme_takipci_kazanc_sonuc['takipci_degisim'] );
		$izlenme_degisim		= sayiFormati( $izlenme_takipci_kazanc_sonuc['izlenme_degisim'] );
		
		if( $izlenme_yuzde < 0 ) {
			$sonuc[ "izlenme_degisim_ve_yuzde" ] = $izlenme_degisim . '<sup style="font-size: 9pt;"><span style="color:#e9521b;"> <i class="fa fa-caret-down"></i>'.$izlenme_yuzde.'%</span></sup>';
		} else {
			$sonuc[ "izlenme_degisim_ve_yuzde" ] = $izlenme_degisim . '<sup style="font-size: 9pt;"><span style="color:#008080;"> <i class="fa fa-caret-up"></i>'.$izlenme_yuzde.'%</span></sup>';
			
		}
		
		if( $takipci_yuzde < 0 ) {
			$sonuc[ "takipci_degisim_ve_yuzde" ] = $takipci_degisim . '<sup style="font-size: 9pt;"><span style="color:#e9521b;"> <i class="fa fa-caret-down"></i>'.$takipci_yuzde.'%</span></sup>';
		} else {
			$sonuc[ "takipci_degisim_ve_yuzde" ] = $takipci_degisim . '<sup style="font-size: 9pt;"><span style="color:#008080;"> <i class="fa fa-caret-up"></i>'.$takipci_yuzde.'%</span></sup>';
			
		}

		$kazanc_min				= sayiFormati( round( $izlenme_takipci_kazanc_sonuc['kazanc_min'] ) );
		$kazanc_max				= sayiFormati( round( $izlenme_takipci_kazanc_sonuc['kazanc_max'] ) );
		$sonuc[ "aylik_kazanc" ]	= "$" . $kazanc_min . " - " . "$" . $kazanc_max;


		// Yıllık kazanç
		$kazanc_min				= sayiFormati( round( $yillik_kazanc_sonuc['kazanc_min'] ) );
		$kazanc_max				= sayiFormati( round( $yillik_kazanc_sonuc['kazanc_max'] ) );
		$sonuc[ "yillik_kazanc" ]	= "$" . $kazanc_min . " - " . "$" . $kazanc_max;



		foreach( $yillik_veriler_sonuc AS &$yillik_veri ) {
			$yillik_veri[ "tarih" ] = tarihFormatiDuzelt( $yillik_veri[ "tarih" ] );
			$yillik_veri[ "takipci_sayisi" ] = sayiFormati( $yillik_veri[ "takipci_sayisi" ] );
			$yillik_veri[ "izlenme_sayisi" ] = sayiFormati( $yillik_veri[ "izlenme_sayisi" ] );
		}
		
		$sonuc[ "yillik_veriler" ] = $yillik_veriler_sonuc;

		return $sonuc;
	} else {
		return 0;
	}
}


function ulkeler() {
	global $SQL_ulkeler;

	$vt = DB();
	$sorguHazir = $vt->prepare( $SQL_ulkeler );
	$sorguHazir->execute( array() );
	$sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );
	return $sonuc; // Tek boyutludur. 
}


function kategoriler() {
	global $SQL_kategoriler;

	$vt = DB();
	$sorguHazir = $vt->prepare( $SQL_kategoriler );
	$sorguHazir->execute( array() );
	$sonuc = $sorguHazir->fetchAll( PDO::FETCH_ASSOC );
	return $sonuc; // Tek boyutludur. 
}


function tarihFormatiDuzelt( $tarih ) {
	$zamanDamgasi = strtotime($tarih);
	$yeniTarih = date("M j, Y", $zamanDamgasi);
	return $yeniTarih;
}


function tarihFormatiDuzeltAyYil($tarih) {
    $zamanDamgasi = strtotime($tarih);
    $yeniTarih = date("M Y", $zamanDamgasi); // "M Y" sadece ay ve yıl bilgisini alır
    return $yeniTarih;
}


function sayiFormatiVirgullu($number) {
    $formattedNumber = number_format($number, 0, '', ',');
    return $formattedNumber;
}


function sayiFormati($number) {
    if ($number >= 1000000000) {
        return round($number / 1000000000, 1) . 'B';
    } elseif ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return $number;
    }
}


function sayiSiraFormati($number) {
    if (!is_numeric($number)) {
        return "--";
    }
    
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        $suffix = '<small>th</small>';
    } else {
        switch ($number % 10) {
            case 1:
                $suffix = '<small>st</small>';
                break;
            case 2:
                $suffix = '<small>nd</small>';
                break;
            case 3:
                $suffix = '<small>rd</small>';
                break;
            default:
                $suffix = '<small>th</small>';
        }
    }
    
    return number_format($number) . $suffix;
}

function ulkeIdVer( $ulke_adi_kisa ) {
	global $SQL_ulke_id;
	
	if( !strlen( $ulke_adi_kisa ) ) return 0;
	
	$vt = DB();
	$sorguHazir = $vt->prepare( $SQL_ulke_id );
	$sorguHazir->execute( array( $ulke_adi_kisa ) );
	$sonuc = $sorguHazir->fetch( PDO::FETCH_ASSOC );
	return $sonuc[ 'id' ];
}

?>