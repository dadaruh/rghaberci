rghaberci
=========
<b>Türkçe:</b><br>
Resmi Gazete Habercisi, o günün TC Resmi Gazetesinde veritabanında kayıtlı kelimeleri arar, arama sonuçlarını kaydeder ve kayıtlı kişi e-posta adreslerine gönderir. Gönderilen e-posta; kullanıcılar için tanımlı anahtar kelime gruplarına (kwgroup) ait anahtar kelime arama sonuçlarından oluşur.
Haberci, PDF formatındaki günlük Resmi Gazeteyi, "wget" ile sunucuya indirir ve "pdftotext" ile metin haline dönüştürüp arama işlemi yapar. Bu nedenle sunucuda bu iki paketin kurulu olması gerekmektedir.

Gönderilen e-posta için template.html kullanılır. Bu şablon, ##alan_adı## özel alanları korunmak koşuluyla değiştirilebilir.

Kullanım için ayarlar config.php dosyasından yapılabilir.

Script bir cron işi olarak tanımlanarak, günlük çalıştırılabilir.

Veritabanı yapısı rghaberci.sql dosyasında yer almaktadır.

____

<b>English:</b><br>
That's a simple PHP script, which aggregates data from daily Offical Gazette of Turkish Republic based on keywords. It saves search results and sends e-mail to related persons using template.html. It uses "wget" to download PDF files and "pdftotext" for convertion.
Keyword group is used for generating e-mail from related search results.
It's needed to configure properly by config.php file.

Script could be defined as a cron job to run daily.

rghaberci.sql file could be used for database structure.
___

<b>Geliştirme Ortamı/Development Enviroment:</b><br>
Ubuntu 12.10<br>
Apache 2.2.22<br>
PHP 5.3.10<br>
MySQL 5.1.66<br>
