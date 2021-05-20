# Tricks winners

## Credits
To help setting up this project, I used [the following repo](https://github.com/guham/symfony-docker) 

##  Requirements

- [Docker](https://docs.docker.com/engine/installation/) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed

## Installation

1. Clone this repository
    ```bash
    $ git clone https://github.com/guham/symfony-docker.git
    ```
2. Update the Docker `.env` file according to your needs. The `NGINX_HOST` environment variable allows you to use a custom server name

3. Add the server name in your system host file

4. Copy the `symfony/.env.dist` file to `symfony/.env`
    ```bash
    $ cp symfony/.env.dist symfony/.env
    ```

5. Build & run containers with `docker-compose` by specifying a second compose file, e.g., with MySQL 
    ```bash
    $ docker-compose -f docker-compose.yaml -f docker-compose.mysql.yaml build
    ```
    then
    ```bash
    $ docker-compose -f docker-compose.yaml -f docker-compose.mysql.yaml up -d
    ```
   

6. Composer install

    first, configure permissions on `symfony/var` folder
    ```bash
    $ docker-compose exec app chown -R www-data:1000 var
    ```
    then
    ```bash
    $ docker-compose exec -u www-data app composer install
    ```

## How to use the application

To run the application I recommend using Postman.

# **Endpoint**

`http://symfony-docker.localhost:8080/run`

*POST*

Pass a list of tricks to the application (13 maximum) and get list of winners.

# **List of cards**

- 1 or Ace
- King
- Queen
- Jack
- 10
- 9
- 8
- 7
- 6
- 5
- 4
- 3
- 2

# **Body of the request**

To use this endpoint you simply need to make a JSON object in the body of the request. 

![](https://i.ibb.co/0J21P72/Capture-d-e-cran-2021-05-20-a-09-18-55.png)

**Constraints**

| Property Name  | Type  | Mandatory  | Description  |
| ------------ | ------------ | ------------ | ------------ |
| TRUMP  | String  | No  |  If you want to use one trump suit just enter his name in this property. (spades, hearts, diamonds, clubs). |
| TRICKS  | JSON Object  |  YES | You need to make a list of JSON objects (you can copy the example bellow). Each object is one trick with four players and each player has two properties (value and color). |

**Payload example**


     {
            "TRUMP": "spades",
            "TRICKS": {
                "1": {
                    "north": {
                    	"value": 1,
                    	"color": "clubs"
                    	
                    },
                    "east":{
                    	"value": 4,
                    	"color": "hearts"
                    	
                    },
                    "south": {
                    	"value": 5,
                    	"color": "diamonds"
                    	
                    },
                    "west": {
                    	"value": 3,
                    	"color": "spades"
                    	
                    }
                },
                "2": {
                    "north": {
                    	"value": 10,
                    	"color": "clubs"
                    	
                    },
                    "east":{
                    	"value": "King",
                    	"color": "hearts"
                    	
                    },
                    "south": {
                    	"value": 5,
                    	"color": "spades"
                    	
                    },
                    "west": {
                    	"value": 3,
                    	"color": "hearts"
                    	
                    }
                }
            }   
        }

# **Response**

The application return one JSON list of winners.

If you run the example, the winners will be the west for the first trick and south for the second thank to the trump.

    [{"value":3,"color":"spades"},{"value":5,"color":"spades"}]



