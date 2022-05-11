# Simply Cache Client

Приложение для демонстрации работы с Redis или Memcached.  
Сначала выполните простую настройку в config.ini.

## command

Добавление данных:  
`./command redis add {key} {value}`  
`./command memcached add {key} {value}`

Удаление данных:  
`./command redis delete {key}`  
`./command memcached delete {key}`  

## API 

### GET /api/[redis|memcached]/[key]
Ответ, если ключ не указан:
```
status: true,
code: 200,
data: {
    {key}: {value},
    {key}: {value},
    {key}: {value},
    ...
}
```
Ответ, если ключ указан:
```
status: true,
code: 200,
data: {
    {key}: {value}
}
```

### DELETE /api/[redis|memcached]/key
Ответ:
```
status: true,
code: 200,
data: {}
```

### В случае ошибки
Ответ:
```
status: false,
code: 500,
data: {
 "message": "Error info message"
}
```