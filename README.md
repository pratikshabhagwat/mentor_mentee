## Prakalpa
## Create 
#### URL
```
https://kitintellect.tech/api_anganwadi/public/prakalpa/create
```
#### Method
```
POST
```
#### Payload
```
{
    "title":"skdajalsd"
}
```

## List All
#### URL
```
https://kitintellect.tech/api_anganwadi/public/prakalpa/listAll
```
#### Method
```
GET
```
#### Response
```
{
  "status": 200,
  "data": [
    {
      "id": "4",
      "title": "skdajalsd"
    },
    {
      "id": "3",
      "title": "skdajalsd"
    },
    {
      "id": "2",
      "title": "skdajalsd"
    },
    {
      "id": "1",
      "title": "ertyhbv"
    }
  ],
  "error": null
}
```
## Read
#### URL
```
https://kitintellect.tech/api_anganwadi/public/prakalpa/{id}
```
#### Method
```
GET
```
#### Response 
```
{
  "status": 200,
  "data": {
    "id": "1",
    "title": "ertyhbv"
  },
  "error": null
}
```
## Delete
#### URL
```
https://kitintellect.tech/api_anganwadi/public/prakalpa/delete/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
  "status": 200,
  "error": null,
  "messages": {
    "response": "Record successfully deleted"
  }
}
```
## Update
#### URL
```
https://kitintellect.tech/api_anganwadi/public/prakalpa/update/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
    "title":"sdsdassd"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "2",
    "title": "sdsdassd"
  },
  "error": null
}
```

## Anganwadi
## Create
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi/create
```
#### Method
```
POST
```
#### Payload
```
{
    "prakalpa_id": "123",
    "bit_id": "12",
    "name": "sdf",
    "aganwadi_no": "123",
    "year": "33ed",
    "state_id": "123123",
    "dist_id": "12",
    "taluka_id": "12",
    "grampanchayat_id": "12",
    "village_id": "12",
    "zip": "213"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "5",
    "prakalpa_id": "123",
    "bit_id": "12",
    "name": "sdf",
    "aganwadi_no": "123",
    "year": "2033",
    "state_id": "123123",
    "dist_id": "0",
    "taluka_id": "12",
    "grampanchayat_id": "12",
    "village_id": "12",
    "zip": "213"
  },
  "error": null
}
```
## List All
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi/listAll
```
#### Method
```
GET
```
#### Response
```
{
  "status": 200,
  "data": [
    {
      "id": "4",
      "prakalpa_id": "23",
      "bit_id": "8",
      "name": "asachj",
      "aganwadi_no": "ravanhje",
      "year": "2023",
      "state_id": "41",
      "dist_id": "0",
      "taluka_id": "45",
      "grampanchayat_id": "77",
      "village_id": "74",
      "zip": "12345"
    },
    {
      "id": "3",
      "prakalpa_id": "23",
      "bit_id": "8",
      "name": "asachj",
      "aganwadi_no": "ravanhje",
      "year": "2023",
      "state_id": "41",
      "dist_id": "0",
      "taluka_id": "45",
      "grampanchayat_id": "77",
      "village_id": "74",
      "zip": "12345"
    },
    {
      "id": "2",
      "prakalpa_id": "23",
      "bit_id": "8",
      "name": "asachj",
      "aganwadi_no": "ravanhje",
      "year": "2023",
      "state_id": "41",
      "dist_id": "0",
      "taluka_id": "45",
      "grampanchayat_id": "77",
      "village_id": "74",
      "zip": "12345"
    },
    {
      "id": "1",
      "prakalpa_id": "0",
      "bit_id": "0",
      "name": "asachj",
      "aganwadi_no": "ravanhje",
      "year": "2023",
      "state_id": "0",
      "dist_id": "0",
      "taluka_id": "0",
      "grampanchayat_id": "0",
      "village_id": "0",
      "zip": "12345"
    }
  ],
  "error": null
}
```
## Read
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi/{id}
```
#### Method
```
show
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "5",
    "prakalpa_id": "123",
    "bit_id": "12",
    "name": "sdf",
    "aganwadi_no": "123",
    "year": "2033",
    "state_id": "123123",
    "dist_id": "0",
    "taluka_id": "12",
    "grampanchayat_id": "12",
    "village_id": "12",
    "zip": "213"
  },
  "error": null
}
```
## Update
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi/update/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
       "aganwadi_no": "asas"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "4",
    "prakalpa_id": "23",
    "bit_id": "8",
    "name": "asachj",
    "aganwadi_no": "asas",
    "year": "2023",
    "state_id": "41",
    "dist_id": "0",
    "taluka_id": "45",
    "grampanchayat_id": "77",
    "village_id": "74",
    "zip": "12345"
  },
  "error": null
}
```
## DELETE
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi/delete/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
  "status": 200,
  "error": null,
  "messages": {
    "response": "Record successfully deleted"
  }
}
```

## BIT
## Create
#### URL
```
https://kitintellect.tech/api_anganwadi/public/bit/create
```
#### Method
```
POST
```
#### Payload
```
{
    "title":"Aslkjsl"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "4",
    "title": "Aslkjsl"
  },
  "error": null
}
```

## Read
#### URL
```
https://kitintellect.tech/api_anganwadi/public/bit/{id}
```
#### Method
```
SHOW
```
#### Response
```
{
  "status": 204,
  "data": [],
  "message": "No Record Found",
  "error": null
}
```

## Update
#### URL
```
https://kitintellect.tech/api_anganwadi/public/bit/update/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
    "title":"Askjkas"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "2",
    "title": "Askjkas"
  },
  "error": null
}
```

## List All
#### URL
```
https://kitintellect.tech/api_anganwadi/public/bit/listAll
```
#### Method
```
GET
```
#### Response
```
{
  "status": 200,
  "data": [
    {
      "id": "4",
      "title": "Aslkjsl"
    },
    {
      "id": "3",
      "title": "33434"
    },
    {
      "id": "2",
      "title": "example"
    }
  ],
  "error": null
}
```

## Delete
#### URL
```
https://kitintellect.tech/api_anganwadi/public/bit/delete/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
  "status": 200,
  "error": null,
  "messages": {
    "response": "Record successfully deleted"
  }
}
```
## Student
## Create
#### URL
```
https://kitintellect.tech/api_anganwadi/public/student/create
```
#### Method
```
POST
```
#### Payload
```
{ "anganwadi_id":"dsf",
 "f_name":"dsf",
 "m_name":"sdf",
 "l_name":"dsff",
 "mother_name":"sdfsd",
 "father_name":"dsfs",
 "dob":"2000-11-12",
 "gender":"male",
 "join_date":"2000-11-12",
 "pass_date":"2000-11-12",
 "join_photo":"aslk.jpeg",
 "pass_photo":"sad;lk.jpeg",
 "state_id":"123",
 "dist_id":"123",
 "taluka_id":"123",
 "grampanchayt_id":"123",
 "village_id":"123",
 "zip_code":"123"}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "2",
    "anganwadi_id": "0",
    "f_name": "dsf",
    "m_name": "sdf",
    "l_name": "dsff",
    "mother_name": "sdfsd",
    "father_name": "dsfs",
    "dob": "2000-11-12",
    "gender": "0",
    "join_date": "2000-11-12",
    "pass_date": "2000-11-12",
    "join_photo": "aslk.jpeg",
    "pass_photo": "sad;lk.jpeg",
    "state_id": "123",
    "dist_id": "123",
    "taluka_id": "123",
    "grampanchayt_id": "123",
    "village_id": "123",
    "zip_code": "123"
  },
  "error": null
}
```
## List All
#### URL
```
https://kitintellect.tech/api_anganwadi/public/students/listAll
```
#### Method
```
GET
```
#### Response
```
{
  "status": 200,
  "data": [
    {
      "id": "2",
      "anganwadi_id": "0",
      "f_name": "dsf",
      "m_name": "sdf",
      "l_name": "dsff",
      "mother_name": "sdfsd",
      "father_name": "dsfs",
      "dob": "2000-11-12",
      "gender": "0",
      "join_date": "2000-11-12",
      "pass_date": "2000-11-12",
      "join_photo": "aslk.jpeg",
      "pass_photo": "sad;lk.jpeg",
      "state_id": "123",
      "dist_id": "123",
      "taluka_id": "123",
      "grampanchayt_id": "123",
      "village_id": "123",
      "zip_code": "123"
    }
  ],
  "error": null
}
```
## Read
#### URL
```
https://kitintellect.tech/api_anganwadi/public/student/{id}
```
#### Method
```
GET
```

#### Response
```
{
  "status": 200,
  "data": {
    "id": "2",
    "anganwadi_id": "0",
    "f_name": "dsf",
    "m_name": "sdf",
    "l_name": "dsff",
    "mother_name": "sdfsd",
    "father_name": "dsfs",
    "dob": "2000-11-12",
    "gender": "0",
    "join_date": "2000-11-12",
    "pass_date": "2000-11-12",
    "join_photo": "aslk.jpeg",
    "pass_photo": "sad;lk.jpeg",
    "state_id": "123",
    "dist_id": "123",
    "taluka_id": "123",
    "grampanchayt_id": "123",
    "village_id": "123",
    "zip_code": "123"
  },
  "error": null
}
```
## Update
#### URL
```
https://kitintellect.tech/api_anganwadi/public/student/update/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
    "f_name":"askj"
}
```
#### Response
```
{
  "status": 200,
  "data": {
    "id": "2",
    "anganwadi_id": "0",
    "f_name": "askj",
    "m_name": "sdf",
    "l_name": "dsff",
    "mother_name": "sdfsd",
    "father_name": "dsfs",
    "dob": "2000-11-12",
    "gender": "0",
    "join_date": "2000-11-12",
    "pass_date": "2000-11-12",
    "join_photo": "aslk.jpeg",
    "pass_photo": "sad;lk.jpeg",
    "state_id": "123",
    "dist_id": "123",
    "taluka_id": "123",
    "grampanchayt_id": "123",
    "village_id": "123",
    "zip_code": "123"
  },
  "error": null
}
```
## Delete
#### URL
```
https://kitintellect.tech/api_anganwadi/public/student/delete/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
  "status": 200,
  "error": null,
  "messages": {
    "response": "Record successfully deleted"
  }
}
```
## Anganwadi Users
#### Create
#### URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi_user
```
#### Method
```
POST
```
#### Payload
```
{
    "anganwadi_id": "156",
    "f_name": "abcd",
    "m_name": "abcde",
    "l_name": "fhjewf",
    "email": "abc1@gmail.com",
    "contact_no": "1234567890",
    "state_id": "0",
    "dist_id": "0",
    "taluka_id": "0",
    "grampanchayat_id": "0",
    "village_id": "0",
    "zip_code": "123445"
}
```
#### Response
```
{
    "status": 200,
    "data": {
        "id": "4",
        "anganwadi_id": "156",
        "f_name": "abcd",
        "m_name": "abcde",
        "l_name": "fhjewf",
        "email": "abc1@gmail.com",
        "contact_no": "1234567890",
        "state_id": "0",
        "dist_id": "0",
        "taluka_id": "0",
        "grampanchayat_id": "0",
        "village_id": "0",
        "zip_code": "123445"
    },
    "error": null
}
```
## List All
####  URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi_user
```
#### Method
```
GET
```
#### Response
```
{
    "status": 200,
    "data": [
        {
            "id": "4",
            "anganwadi_id": "156",
            "f_name": "abcd",
            "m_name": "abcde",
            "l_name": "fhjewf",
            "email": "abc1@gmail.com",
            "contact_no": "1234567890",
            "state_id": "0",
            "dist_id": "0",
            "taluka_id": "0",
            "grampanchayat_id": "0",
            "village_id": "0",
            "zip_code": "123445"
        },
        {
            "id": "3",
            "anganwadi_id": "156",
            "f_name": "abcd",
            "m_name": "abcde",
            "l_name": "fhjewf",
            "email": "abc1@gmail.com",
            "contact_no": "1234567890",
            "state_id": "0",
            "dist_id": "0",
            "taluka_id": "0",
            "grampanchayat_id": "0",
            "village_id": "0",
            "zip_code": "123445"
        },
        {
            "id": "2",
            "anganwadi_id": "123",
            "f_name": "abc",
            "m_name": "abcd",
            "l_name": "xyz",
            "email": "abc@gmail.com",
            "contact_no": "1234567890",
            "state_id": "0",
            "dist_id": "0",
            "taluka_id": "0",
            "grampanchayat_id": "0",
            "village_id": "0",
            "zip_code": "123456"
        }
    ],
    "error": null
}
```
## Read
####  URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi_user/{id}
```
#### Method
```
GET
```
#### Response
```
{
    "status": 200,
    "data": {
        "id": "4",
        "anganwadi_id": "156",
        "f_name": "abcd",
        "m_name": "abcde",
        "l_name": "fhjewf",
        "email": "abc1@gmail.com",
        "contact_no": "1234567890",
        "state_id": "0",
        "dist_id": "0",
        "taluka_id": "0",
        "grampanchayat_id": "0",
        "village_id": "0",
        "zip_code": "123445"
    },
    "error": null
}
```
## Update
####  URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi_user/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
    "anganwadi_id":156   
}
```
#### Response
```
{
    "status": 200,
    "data": {
        "id": "3",
        "anganwadi_id": "156",
        "f_name": "abcd",
        "m_name": "abcde",
        "l_name": "fhjewf",
        "email": "abc1@gmail.com",
        "contact_no": "1234567890",
        "state_id": "0",
        "dist_id": "0",
        "taluka_id": "0",
        "grampanchayat_id": "0",
        "village_id": "0",
        "zip_code": "123445"
    },
    "error": null
}
```
## Delete
####  URL
```
https://kitintellect.tech/api_anganwadi/public/anganwadi_user/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
    "status": 200,
    "error": null,
    "messages": {
        "response": "Record successfully deleted"
    }
}
```
## Users
## List All
#### URL
```
https://kitintellect.tech/api_anganwadi/public/users/listAll
```
#### Method
```
GET
```
#### Response
```
{
    "status": 200,
    "data": [
        {
            "id": "3",
            "role_id": "0",
            "password": "",
            "f_name": "",
            "m_name": "",
            "l_name": "",
            "email": "",
            "contact_no": "",
            "state": "0",
            "district": "0",
            "block": "0",
            "village": "0",
            "zip_code": "8867"
        },
        {
            "id": "2",
            "role_id": "123",
            "password": "234",
            "f_name": "aasf",
            "m_name": "dfas",
            "l_name": "",
            "email": "sadf",
            "contact_no": "234",
            "state": "234",
            "district": "3245",
            "block": "345",
            "village": "2345",
            "zip_code": "2345"
        },
        {
            "id": "1",
            "role_id": "123",
            "password": "234",
            "f_name": "aasf",
            "m_name": "dfas",
            "l_name": "",
            "email": "sadf",
            "contact_no": "234",
            "state": "234",
            "district": "3245",
            "block": "345",
            "village": "2345",
            "zip_code": "2345"
        }
    ],
    "error": null
}
```
## Create
#### URL
```
https://kitintellect.tech/api_anganwadi/public/user/create
```
#### Method
```
POST
```
#### Payload
```
{
    "role_id": "2",
    "password": "fwfe",
    "f_name": "ewfef",
    "m_name": "wefewf",
    "l_name": "asfdfwe",
    "email": "xyz@gmail.com",
    "contact_no": 12345678798,
    "state": "3",
    "district": "3",
    "block": "5",
    "village": "5",
    "zip_code": "5657"
}
```
#### Response
```
{
    "status": "200",
    "data": {
        "id": "4",
        "role_id": "2",
        "password": "fwfe",
        "f_name": "ewfef",
        "m_name": "wefewf",
        "l_name": "asfdfwe",
        "email": "xyz@gmail.com",
        "contact_no": "12345678798",
        "state": "0",
        "district": "0",
        "block": "0",
        "village": "0",
        "zip_code": "5657"
    },
    "message": "Record inserted successfully"
}
```
## Read
#### URL
```
https://kitintellect.tech/api_anganwadi/public/user/{id}
```
#### Method
```
GET
```
#### Response
```
{
    "status": 200,
    "message": "Record fetched successfully",
    "data": {
        "id": "4",
        "role_id": "2",
        "password": "fwfe",
        "f_name": "ewfef",
        "m_name": "wefewf",
        "l_name": "asfdfwe",
        "email": "xyz@gmail.com",
        "contact_no": "12345678798",
        "state": "0",
        "district": "0",
        "block": "0",
        "village": "0",
        "zip_code": "5657"
    }
}
```
## Update
#### URL
```
https://kitintellect.tech/api_anganwadi/public/user/update/{id}
```
#### Method
```
PATCH
```
#### Payload
```
{
    "role_id": "4"
}
```
#### Response
```
{
    "status": 200,
    "message": "Record fetched successfully",
    "data": {
        "id": "4",
        "role_id": "4",
        "password": "fwfe",
        "f_name": "ewfef",
        "m_name": "wefewf",
        "l_name": "asfdfwe",
        "email": "xyz@gmail.com",
        "contact_no": "12345678798",
        "state": "0",
        "district": "0",
        "block": "0",
        "village": "0",
        "zip_code": "5657"
    }
}
```
## Delete
#### URL
```
https://kitintellect.tech/api_anganwadi/public/user/delete/{id}
```
#### Method
```
DELETE
```
#### Response
```
{
    "status": 200,
    "error": null,
    "messages": {
        "response": "Record successfully deleted"
    }
}
```
