<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      font-weight: bold;
    }
    .book-list {
      list-style-type: none;
      padding: 0;
    }
    .book-item {
      padding: 15px 0;
      border-bottom: 1px solid #ccc;
    }
    .book-title {
      font-weight: bold;
      font-size: 1.2em;
    }
    .book-author {
      color: #666;
      font-size: 1em;
    }
  </style>
</head>
<body>
  <h1>Book List</h1>
  <button onclick="fetchData()">Load Book Data</button>
  <ul id="data-container" class="book-list"></ul>

  <script>
    const apiUrl = 'http://127.0.0.1:8000/api/buku';

    async function fetchData() {
      try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
          throw new Error('Failed to fetch data from API');
        }
        const result = await response.json();

        if (result.success) {
          displayData(result.data.data); // result.data.data refers to the book array
        } else {
          document.getElementById('data-container').innerText = 'No book data available';
        }
      } catch (error) {
        console.error('Error:', error);
        document.getElementById('data-container').innerText = 'Error fetching data';
      }
    }

    function displayData(books) {
      const container = document.getElementById('data-container');
      container.innerHTML = ''; // Clear container before displaying new data

      books.forEach(book => {
        const listItem = document.createElement('li');
        listItem.className = 'book-item';

        listItem.innerHTML = `
          <div class="book-title">${book.judul}</div>
          <div class="book-author">by ${book.penulis}</div>
        `;
        container.appendChild(listItem);
      });
    }
  </script>
</body>
</html>
