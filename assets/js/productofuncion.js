document.getElementById('toggleIcon').addEventListener('click', function () {
    var articleContent = document.getElementById('articleContent');
    if (articleContent.style.display === 'none' || articleContent.style.display === '') {
        articleContent.style.display = 'block';
    } else {
        articleContent.style.display = 'none';
    }
});