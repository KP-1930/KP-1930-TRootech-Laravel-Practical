<!-- #Admin Panel Documentation -->
=> User Authentication : Login , Logout, and password reset functionality
=> Role and Permission Management set using spatie role permission package
=> Admin Panel Features 
   -> User Management
   -> Role Management
   -> Dashboard (with user count as well as role count)
=> Role & Permission Middleware

<!-- in projection permission be like -->
1) Role : admin   => Permission : ['role-create','role-edit','role-list','role-delete']  (Full Rights)
2) Role : viewer  => Permission : ['role-list','role-edit'] 
3) Role : editor  => Permission : ['role-list'] 

video link : https://www.awesomescreenshot.com/video/32005218?key=e7d7603138071872960e0dfe928d7c86


Here are step for run project : 
1) set database credentials as well as set mail credentials for password reset functionality
2) run migration
3) run seeder


<!-- API Documentation -->
=> created api for registration, login with token based
=> Token Expiration functionality managed
=> Error Handling and Validation set

<!-- API Lists -->
1) registration api

    - URL : http://127.0.0.1:8000/api/register
    - method : POST
    - params : {
        "name" : "test",
        "email" :"test@gmail.com",
        "password" : "11111",
        "confirm_password" : "11111"                        
       }
    - ressponse : {
        "success": true,
        "data": {
            "token": "1|5xZIkOj4cKxCEkYMcBFcHpUmBriUXRnGEq09uaJG",
            "name": "test"
        },
        "message": "Register successfully."
     }

2) Login API 

    - URL : http://127.0.0.1:8000/api/login
    - method : POST
    - params : {
            "email" : "test@gmail.com",
            "password" : "11111"
        }
    - ressponse : {
        "success": true,
        "data": {
            "token": "10|9PRi03ps4TfWY0xfL6seagCKwemXztL6HUfMyLFM",
            "name": "test",
            "expires_at": "2024-09-27 18:26:23"
        },
        "message": "User login successfully."
    }

 3) Category API (token based access)

   1) Category List  
    - URL : http://127.0.0.1:8000/api/category
    - method : GET
    - params : Token Required
    - response : {
            "success": true,
            "data": [
                {
                    "id": 1,
                    "name": "car",
                    "description": "bmw",
                    "created_at": "2024-09-27T18:01:25.000000Z",
                    "updated_at": "2024-09-27T18:01:25.000000Z"
                },
                {
                    "id": 2,
                    "name": "car2",
                    "description": "bmw2",
                    "created_at": "2024-09-27T18:08:03.000000Z",
                    "updated_at": "2024-09-27T18:08:03.000000Z"
                }
            ],
              "message": "Category retrieved successfully."
          }
    
    2) category create

    - URL : http://127.0.0.1:8000/api/category/store
    - method : POST
    - Token : Token Required,
    - params : {
            "name" : "car2",
            "description" : "bmw2"
        }
    - response : {
        "success": true,
        "data": {
            "name": "car2",
            "description": "bmw2",
            "updated_at": "2024-09-27T18:35:28.000000Z",
            "created_at": "2024-09-27T18:35:28.000000Z",
            "id": 3
        },
        "message": "Category created successfully."
    }

    3) getIdBasedCategory

    - URL : http://127.0.0.1:8000/api/category/show/{id}
    - method : GET
    - Token : Token Required,
    - response : {
        "success": true,
        "data": {
            "id": 1,
            "name": "car",
            "description": "bmw",
            "created_at": "2024-09-27T18:01:25.000000Z",
            "updated_at": "2024-09-27T18:01:25.000000Z"
        },
        "message": "Category retrieved successfully."
    }

    4) category update

    - URL : http://127.0.0.1:8000/api/category/update/{id}
    - method : PUT
    - Token : Token Required,
    - params : {
            "name" : "car2",
            "description" : "bmw2"
        }
    - response : {
        "success": true,
        "data": {
            "id": 2,
            "name": "table",
            "description": "good furniture",
            "created_at": "2024-09-27T18:08:03.000000Z",
            "updated_at": "2024-09-27T18:09:44.000000Z"
        },
        "message": "Category updated successfully."
    }

    5) deleteCategory

    - URL : http://127.0.0.1:8000/api/category/delete/{id}
    - method : GET
    - Token : Token Required,
    - response : {
        "success": true,
        "data": [],
        "message": "Category deleted successfully."
    }
    

