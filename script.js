document.getElementById('whois-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const domain = document.getElementById('domain').value;

    const domainRegex = /^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!domainRegex.test(domain)) {
        alert('Geçerli bir alan adı girin.');
        return;
    }

    document.getElementById('loading').style.display = 'block';
    document.getElementById('result').style.display = 'none';
    document.querySelector('.action-buttons').style.display = 'none'; // Yeni Sorgu ve Gece/Gündüz Modu butonlarını gizle
    document.getElementById('page-title').style.display = 'none'; // Başlığı gizle

    fetch('whois.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'domain': domain
        })
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('result').style.display = 'block';
        document.getElementById('result').innerHTML = data;
        document.getElementById('domain').value = '';
        document.getElementById('whois-form').style.display = 'none'; // Formu gizle
        document.querySelector('.action-buttons').style.display = 'flex'; // Yeni Sorgu ve Gece/Gündüz Modu butonlarını göster
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
    });
});

document.getElementById('toggle-theme').addEventListener('click', function() {
    const body = document.body;
    body.classList.toggle('night-mode');
    
    const themeButton = document.getElementById('toggle-theme');
    if (body.classList.contains('night-mode')) {
        themeButton.innerHTML = '<i class="fas fa-sun"></i>';
    } else {
        themeButton.innerHTML = '<i class="fas fa-moon"></i>';
    }
});

document.getElementById('new-search').addEventListener('click', function() {
    document.getElementById('result').style.display = 'none';
    document.getElementById('whois-form').style.display = 'block'; // Formu tekrar göster
    document.getElementById('page-title').style.display = 'block'; // Başlığı tekrar göster
    document.querySelector('.action-buttons').style.display = 'none'; // Yeni Sorgu ve Gece/Gündüz Modu butonlarını gizle
});

function showPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
