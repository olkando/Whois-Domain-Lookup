<?php
if (isset($_POST['domain'])) {
    $apiKey = "";
    $domain = filter_var($_POST['domain'], FILTER_SANITIZE_STRING);
    $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey={$apiKey}&domainName={$domain}&outputFormat=JSON";

    $response = file_get_contents($url);
    if ($response === FALSE) {
        echo "API isteği başarısız oldu. Lütfen daha sonra tekrar deneyin.";
        exit();
    }
    
    $data = json_decode($response, true);

    if (isset($data['ErrorMessage'])) {
        echo "Hata: " . htmlspecialchars($data['ErrorMessage']);
        exit();
    }

    // Verileri işleyelim
    $domainName = htmlspecialchars($data['WhoisRecord']['domainName'] ?? '-');
    $registryDomainId = htmlspecialchars($data['WhoisRecord']['registryDomainId'] ?? '-');
    $registrar = htmlspecialchars($data['WhoisRecord']['registrarName'] ?? '-');
    $registrarIANAId = htmlspecialchars($data['WhoisRecord']['registrarIANAID'] ?? '-');
    $registrarURL = htmlspecialchars($data['WhoisRecord']['registrarURL'] ?? '-');
    $creationDate = htmlspecialchars($data['WhoisRecord']['createdDate'] ?? '-');
    $updatedDate = htmlspecialchars($data['WhoisRecord']['updatedDate'] ?? '-');
    $expirationDate = htmlspecialchars($data['WhoisRecord']['expiresDate'] ?? '-');
    $registrarAbuseContactEmail = htmlspecialchars($data['contactEmail'] ?? '-');
    $registrarAbuseContactPhone = htmlspecialchars($data['WhoisRecord']['contactPhone'] ?? '-');
    $domainStatus = htmlspecialchars($data['WhoisRecord']['status'] ?? '-');
    $registrantOrganization = htmlspecialchars($data['WhoisRecord']['registrant']['organization'] ?? '-');
    $registrantState = htmlspecialchars($data['WhoisRecord']['registrant']['state'] ?? '-');
    $registrantCountry = htmlspecialchars($data['WhoisRecord']['registrant']['country'] ?? '-');
    $adminOrganization = htmlspecialchars($data['WhoisRecord']['administrativeContact']['organization'] ?? '-');
    $adminState = htmlspecialchars($data['WhoisRecord']['administrativeContact']['state'] ?? '-');
    $adminCountry = htmlspecialchars($data['WhoisRecord']['administrativeContact']['country'] ?? '-');
    $techOrganization = htmlspecialchars($data['WhoisRecord']['technicalContact']['organization'] ?? '-');
    $techState = htmlspecialchars($data['WhoisRecord']['technicalContact']['state'] ?? '-');
    $techCountry = htmlspecialchars($data['WhoisRecord']['technicalContact']['country'] ?? '-');
    $nameServers = isset($data['WhoisRecord']['nameServers']['hostNames']) ? htmlspecialchars(implode(', ', $data['WhoisRecord']['nameServers']['hostNames'])) : '-';

    // Tarih formatlarını dönüştürme
    $creationDate = ($creationDate != '-') ? date("d-m-Y H:i:s", strtotime($creationDate)) : '-';
    $updatedDate = ($updatedDate != '-') ? date("d-m-Y H:i:s", strtotime($updatedDate)) : '-';
    $expirationDate = ($expirationDate != '-') ? date("d-m-Y H:i:s", strtotime($expirationDate)) : '-';

    // Domain yaşını hesaplama
    $domainAge = '-';
    if ($creationDate != '-') {
        $createdDateTime = new DateTime($data['WhoisRecord']['createdDate']);
        $currentDateTime = new DateTime();
        $interval = $createdDateTime->diff($currentDateTime);
        $domainAge = $interval->y . " yıl, " . $interval->m . " ay, " . $interval->d . " gün";
    }

    // Domain durumunu liste halinde gösterme ve daha kullanıcı dostu hale getirme
    $statusTranslations = [
        "clientTransferProhibited" => "Transfer Yasağı (Müşteri)",
        "clientUpdateProhibited" => "Güncelleme Yasağı (Müşteri)",
        "clientRenewProhibited" => "Yenileme Yasağı (Müşteri)",
        "clientDeleteProhibited" => "Silme Yasağı (Müşteri)",
        "serverDeleteProhibited" => "Silme Yasağı (Sunucu)",
        "serverTransferProhibited" => "Transfer Yasağı (Sunucu)",
        "serverUpdateProhibited" => "Güncelleme Yasağı (Sunucu)",
        "transferPeriod" => "Transfer Dönemi"
    ];
    
    $statusList = explode(' ', $domainStatus);
    $statusHtml = '<ul>';
    foreach ($statusList as $status) {
        $statusHtml .= "<li>" . htmlspecialchars($statusTranslations[$status] ?? $status) . "</li>";
    }
    $statusHtml .= '</ul>';

    $result = "
        <div class='whois-data'>
            <h2><i class='fas fa-info-circle'></i> WHOIS Verileri: {$domainName}</h2>
            <table>
                <tr><th>Alan Adı:</th><td>{$domainName}</td></tr>
                <tr><th>Kayıt Domain ID'si:</th><td>{$registryDomainId}</td></tr>
                <tr><th>Kayıt Yeri:</th><td>{$registrar}</td></tr>
                <tr><th>Kayıt Yeri IANA ID'si:</th><td>{$registrarIANAId}</td></tr>
                <tr><th>Kayıt Yeri URL'si:</th><td>{$registrarURL}</td></tr>
                <tr><th>Oluşturulma:</th><td>{$creationDate}</td></tr>
                <tr><th>Güncelleme:</th><td>{$updatedDate}</td></tr>
                <tr><th>Sona Erme:</th><td>{$expirationDate}</td></tr>
                <tr><th>Kayıt Yeri İhlal İletişim E-postası:</th><td>{$registrarAbuseContactEmail}</td></tr>
                <tr><th>Domain Durumu:</th><td>{$statusHtml}</td></tr>
                <tr><th>Kaydeden Kuruluş:</th><td>{$registrantOrganization}</td></tr>
                <tr><th>Kaydeden Eyalet/İl:</th><td>{$registrantState}</td></tr>
                <tr><th>Kaydeden Ülke:</th><td>{$registrantCountry}</td></tr>
                <tr><th>Yönetici Kuruluş:</th><td>{$adminOrganization}</td></tr>
                <tr><th>Yönetici Eyalet/İl:</th><td>{$adminState}</td></tr>
                <tr><th>Yönetici Ülke:</th><td>{$adminCountry}</td></tr>
                <tr><th>Teknik Kuruluş:</th><td>{$techOrganization}</td></tr>
                <tr><th>Teknik Eyalet/İl:</th><td>{$techState}</td></tr>
                <tr><th>Teknik Ülke:</th><td>{$techCountry}</td></tr>
                <tr><th>Name Servers:</th><td>{$nameServers}</td></tr>
                <tr><th>Domain Yaşı:</th><td>{$domainAge}</td></tr>
            </table>
        </div>
    ";

    echo $result;
} else {
    echo "Alan adı belirtilmedi.";
}
?>
