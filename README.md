<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whois Domain Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            color: #333;
        }
        h1, h2, h3 {
            color: #0056b3;
        }
        a {
            color: #1a73e8;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 4px;
            border-radius: 4px;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>
<body>

<h1>Whois Domain Lookup</h1>

<h2>Proje Hakkında</h2>

<p>
    <strong>Whois Domain Lookup</strong>, kullanıcıların alan adlarının kayıt bilgilerini hızlı ve kolay bir şekilde öğrenmelerini sağlayan bir web uygulamasıdır. Proje, modern bir tasarıma sahiptir ve gece/gündüz modu gibi kullanışlı özellikler sunar.
</p>

<h3>Demo</h3>
<p>
    Projenin canlı demosunu aşağıdaki bağlantıdan görüntüleyebilirsiniz:
    <a href="https://whois.olkando.com/" target="_blank">Whois Domain Lookup Demo</a>
</p>

<h2>Başlarken</h2>
<p>
    Bu rehber, projeyi yerel bir ortamda kurmanıza ve çalıştırmanıza yardımcı olacaktır.
</p>

<h3>Gereksinimler</h3>
<ul>
    <li>PHP 7.4 veya daha üstü</li>
    <li>Web sunucusu (Apache, Nginx vb.)</li>
    <li>Git</li>
    <li>API anahtarı (whoisxmlapi.com üzerinden alınabilir)</li>
</ul>

<h3>Kurulum</h3>
<ol>
    <li>
        <strong>Proje Deposunu Klonlayın</strong>
        <pre><code>git clone https://github.com/olkan/WhoisDomainLookup.git</code></pre>
    </li>
    <li>
        <strong>Proje Dizininize Geçin</strong>
        <pre><code>cd WhoisDomainLookup</code></pre>
    </li>
    <li>
        <strong>Gerekli Bağımlılıkları Kurun</strong>
        <p>
            Bağımlılıkların yüklü olduğundan emin olun. Örneğin, PHP için gerekli uzantıları kurun.
        </p>
    </li>
    <li>
        <strong>API Anahtarını Ayarlayın</strong>
        <p>
            <code>whois.php</code> dosyasında yer alan API anahtarınızı güncelleyin:
        </p>
        <pre><code>$apiKey = 'Sizin-API-Anahtarınız';</code></pre>
    </li>
    <li>
        <strong>Sunucuyu Başlatın</strong>
        <p>
            PHP yerleşik sunucusunu kullanarak projeyi başlatabilirsiniz:
        </p>
        <pre><code>php -S localhost:8000</code></pre>
        <p>
            Tarayıcınızda <a href="http://localhost:8000" target="_blank">http://localhost:8000</a> adresine giderek uygulamayı görüntüleyebilirsiniz.
        </p>
    </li>
</ol>

<h2>Kullanım</h2>
<ol>
    <li>
        <strong>Alan Adı Sorgulama</strong>
        <p>
            Anasayfada yer alan giriş alanına sorgulamak istediğiniz alan adını yazın ve "Sorgula" butonuna tıklayın. Sonuçlar hemen aşağıda görünecektir.
        </p>
    </li>
    <li>
        <strong>Gece/Gündüz Modu</strong>
        <p>
            Sağ üst köşede yer alan ay simgesine tıklayarak gece moduna, güneş simgesine tıklayarak gündüz moduna geçiş yapabilirsiniz.
        </p>
    </li>
    <li>
        <strong>Yeni Sorgu</strong>
        <p>
            Sonuçlar görüntülendikten sonra "Yeni Sorgu" butonuna tıklayarak yeni bir sorgulama yapabilirsiniz.
        </p>
    </li>
</ol>

<h2>Özellikler</h2>
<ul>
    <li><strong>Modern ve Responsive Tasarım:</strong> Uygulama, tüm cihazlarda uyumlu olacak şekilde tasarlanmıştır.</li>
    <li><strong>Gece/Gündüz Modu:</strong> Kullanıcı deneyimini artırmak için tema modları sunulmaktadır.</li>
    <li><strong>Hızlı ve Doğru Sorgulama:</strong> Kullanıcılar, alan adı bilgilerine hızlı bir şekilde erişebilir.</li>
</ul>

<h2>Katkıda Bulunma</h2>
<p>
    Katkıda bulunmak isterseniz, lütfen bir çekme isteği (pull request) gönderin. Büyük değişiklikler için, lütfen önce neyi değiştirmek istediğinizi tartışmak üzere bir konu açın.
</p>

<h2>Lisans</h2>
<p>
    Bu proje MIT lisansı ile lisanslanmıştır. Daha fazla bilgi için <code>LICENSE</code> dosyasına bakın.
</p>

<h2>İletişim</h2>
<p>
    Herhangi bir sorunuz veya öneriniz varsa, lütfen <a href="mailto:email@example.com">e-posta adresiniz</a> üzerinden benimle iletişime geçmekten çekinmeyin.
</p>

<hr>

<p>
    Bu proje, alan adı kayıt bilgilerini daha erişilebilir ve kullanıcı dostu hale getirmek amacıyla geliştirilmiştir. Umarım projemiz sizin için faydalı olur!
</p>

</body>
</html>
