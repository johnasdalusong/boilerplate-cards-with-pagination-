<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Card Pagination</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row" id="card-container">
            <!-- Cards will be dynamically added here -->
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination links will be dynamically added here -->
            </ul>
        </nav>
    </div>

    <script>
        // Sample data (replace with your own)
        const data = [
            { title: "Card 1", content: "Content for Card 1" },
            { title: "Card 2", content: "Content for Card 2" },
            { title: "Card 3", content: "Content for Card 3" },
            // Add more data as needed
        ];

        // Pagination settings
        const itemsPerPage = 2;
        let currentPage = 1;

        // Function to render cards for the current page
        function renderCards() {
            const container = document.getElementById('card-container');
            container.innerHTML = '';

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            for (let i = startIndex; i < endIndex && i < data.length; i++) {
                const card = data[i];
                const cardHtml = `
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${card.title}</h5>
                                <p class="card-text">${card.content}</p>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += cardHtml;
            }
        }

        // Function to render pagination links
        function renderPagination() {
            const totalPages = Math.ceil(data.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
                pagination.appendChild(li);

                // Add event listener to pagination links
                li.addEventListener('click', function(event) {
                    event.preventDefault();
                    currentPage = parseInt(event.target.dataset.page);
                    renderCards();
                    updateActivePage();
                });
            }

            // Update active page link
            updateActivePage();
        }

        // Function to update active page link
        function updateActivePage() {
            const pagination = document.getElementById('pagination');
            const links = pagination.getElementsByTagName('a');
            for (let i = 0; i < links.length; i++) {
                links[i].classList.remove('active');
                if (parseInt(links[i].dataset.page) === currentPage) {
                    links[i].classList.add('active');
                }
            }
        }

        // Initial render
        renderCards();
        renderPagination();
    </script>
</body>
</html>
