# Snowtricks

# Openclassrooms project 6
```
Development of a community site based on symfony 4.
```

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/763a39ae9f95437ca40e02a3869af5bb)](https://www.codacy.com/manual/siggwer/Snowtricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=siggwer/Snowtricks&amp;utm_campaign=Badge_Grade)

## Installation

Clone this repository.
```
git clone https://github.com/siggwer/Snowtricks.git
```

Install dependencies
```
composer install
```

Create and edit a new env file `.env.local`
```
# .env.local
DATABASE_URL=mysql://your_login:your_password@127.0.0.1:3306/your-databasename
```

Create the database 
```
bin/console doctrine:database:create
```

Load the fixtures
```
bin/console composer prepare
```

Start the server
```
bin/console server:run
```

Enjoy!
