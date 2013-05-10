rghaberci
=========
<b>Türkçe:</b><br>
Resmi Gazete Habercisi, o günün TC Resmi Gazetesinde veritabanında kayıtlı kelimeleri arar, arama sonuçlarını kaydeder ve kayıtlı kişi e-posta adreslerine gönderir.
Haberci, PDF formatındaki günlük Resmi Gazeteyi, "wget" ile sunucuya indirir ve "pdftotext" ile metin haline dönüştürüp arama işlemi yapar. Bu nedenle sunucuda bu iki paketin kurulu olması gerekmektedir.
Gönderilen e-posta için template.html kullanılır. Bu şablon, ##alan_adı## özel alanları korunmak koşuluyla değiştirilebilir.

Kullanım için ayarlar config.php dosyasından yapılabilir.

____

<b>English:</b><br>
That's a simple PHP script, which aggregates data from daily Offical Gazette of Turkish Republic based on keywords. It saves search results and sends e-mail to related persons using template.html. It uses "wget" to download PDF files and "pdftotext" for convertion.

It's needed to configure properly by config.php file.
___

<b>Geliştirme Ortamı/Development Enviroment:</b><br>
Ubuntu 12.10<br>
Apache 2.2.22<br>
PHP 5.3.10<br>
MySQL 5.1.66<br>
