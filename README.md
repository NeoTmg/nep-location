# 🇳🇵 Nepali Location Hierarchy for Laravel 

A Laravel package to manage and query **Nepali administrative locations**, including **Provinces**, **Districts**, **Municipalities/Rural Municipalities (Palika)**, 
— all structured in a clean, hierarchical format.
---

## 📦 Package Name
neo/nep-location-hierarchy

---

## 🎯 Features

- ✅ Provinces, Districts, Palikas (Municipality/Rural Municipality)
- ✅ Seeders included with official Nepali administrative data
- ✅ Easy Eloquent relationships
- ✅ API-ready structure
- ✅ Artisan commands to refresh location data
- ✅ Useful for form dropdowns, analytics, and geolocation logic

---

## 🛠️ Installation

```bash
composer require neo/nep-location-hierarchy

Publish the migrations and seeders:
php artisan vendor:publish --tag=nep-location-hierarchy
php artisan migrate 

🏗️ Usage Example
Accessing Province Data
use Neo\NepLocation\Models\Province;

$provinces = Province::all();

🧱 Database Structure
provinces
districts
palikas

All models come with proper Eloquent relationships and can be extended as needed.

✨ Use Cases
Cascading dropdowns in forms (Province → District → Palika)

Regional analytics & reporting

Address management for logistics or e-commerce

Government data integration

🤝 Contributing
Contributions, pull requests, and issues are welcome! Please open an issue or submit a PR.

📜 License
This package is open-sourced software licensed under the MIT license.
 


