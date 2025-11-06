# 📰 Laravel News Aggregator

A backend take-home challenge for a **Backend Developer** position.  
This Laravel application aggregates and serves articles from multiple news APIs — **NewsAPI**, **The Guardian**, and **New York Times** — via a clean REST API.

---

## 🚀 Features
- Fetches and stores news from **3 APIs**
- Normalized schema for all sources
- RESTful API with filtering and pagination
- Built with **Laravel 11**, **MySQL**, **Guzzle**, and **Eloquent**
- Follows SOLID, DRY, and KISS principles
- Scheduler-ready for automatic data updates

---

## 🧱 Tech Stack
| Component | Tool |
|------------|------|
| Backend Framework | Laravel 11 |
| Database | MySQL |
| HTTP Client | Guzzle |
| Language | PHP 8.2+ |
| Architecture | Service-based, REST API |
| Container | Laravel Artisan / optional Docker |

---

## ⚙️ Installation

```bash
# 1. Clone this repo
git clone https://github.com/qistuna456/news-aggregator.git
cd news-aggregator

# 2. Install dependencies
composer install

# 3. Copy environment config
cp .env.example .env

# 4. Set up your .env variables
APP_NAME="News Aggregator"
APP_URL=http://news-aggregator.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_aggregator
DB_USERNAME=root
DB_PASSWORD=

# API keys
NEWSAPI_KEY=your_newsapi_key_here
GUARDIAN_KEY=your_guardian_api_key_here
NYT_KEY=your_nyt_key_here

# 5. Generate app key
php artisan key:generate

# 6. Run migrations & seeders
php artisan migrate --seed

# 7. (Optional) Fetch articles
php artisan fetch:articles
```

---

## 📡 **API Endpoints**

| Endpoint | Method | Description |
|-----------|---------|-------------|
| `/api/v1/articles` | GET | List all articles (with pagination) |
| `/api/v1/articles?q=tech` | GET | Search articles by keyword |
| `/api/v1/articles?source=newsapi` | GET | Filter by source |
| `/api/v1/articles/{id}` | GET | View single article |
| `/api/v1/sources` | GET | List all news sources |

---

## 🧠 **Commands**
# Fetch from all sources
```bash
php artisan fetch:articles
```

# Fetch only Guardian
```bash
php artisan fetch:articles guardian
```

# Fetch only NYT
```bash
php artisan fetch:articles nytimes
```
---

## ⏰ Scheduler (Optional)
To fetch articles automatically every 30 minutes:

php artisan schedule:work

---

## 🧩 Folder Structure**
app/
 ├── Console/
 │    └── Commands/
 │         └── FetchArticlesCommand.php
 ├── Models/
 ├── Services/
 │    ├── NewsFetcherInterface.php
 │    ├── NewsApiFetcher.php
 │    ├── GuardianFetcher.php
 │    ├── NytFetcher.php
 │    └── ArticleService.php
routes/
 └── api.php

---
## 🧪 Testing the API (PowerShell)
Invoke-RestMethod -Uri "http://news-aggregator.test/api/v1/articles" -Method GET | ConvertTo-Json -Depth 5

---
## 🧭 Future Improvements

Caching with Redis

User authentication

Queue jobs for background fetch

API rate limiting

Swagger/OpenAPI documentation

---

## 👤 Author
Qistuna ‘Ilmi Yusof
Backend Developer • Laravel • PHP • REST APIs
