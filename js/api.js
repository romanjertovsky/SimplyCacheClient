/**
 * Скрипт ожидает загрузки DOM (в конце)
 * и устанавливает на классы соответствующие обработчики.
 *
 * Используемые в скрипте переменные:
 * - ApiUrl
 * - DataEngine
 * объявлены в начале вьюхи web_index, они там берутся из config.ini
 *
 */


function addLi(key, val) {
    const main_list = document.getElementById('main_list');

    main_list.innerHTML +=
        `<li id="li_${key}">${key}:${val} <a href="#" class="remove" id="${key}">del</a></li>`;

    addListener('remove', confirmIt, 'click')
    addListener('remove', postDelete, 'click')
}


function addLog(sMessage) {
    const div_log = document.getElementById('div_log');
    div_log.innerHTML += `${sMessage}<br/>`;
}


// Обработчик delete-запроса
function postDelete(event) {

    console.log('Listener postDelete called')

    // Отмена действия по умолчанию
    event.preventDefault()

    let id = event.target.id

    let aSendData = {
        key: id
    }

    let oXhr = new XMLHttpRequest()
    oXhr.open('DELETE', ApiUrl + DataEngine, true)
    oXhr.setRequestHeader('Content-Type', 'application/json')
    oXhr.responseType = 'json';

    // Обработчик ответа
    oXhr.onload = function() {

        if (oXhr.status === 200) {

            document.getElementById('li_' + id).remove()
            console.log(oXhr.response)

        } else {

            let aList = oXhr.response.data
            addLog(aList[0].message)
        }

    }

    oXhr.send(JSON.stringify(aSendData))

}


function getList() {

    console.log('Function getList called')

    let oXhr = new XMLHttpRequest();
    oXhr.open('GET', ApiUrl + DataEngine, true);
    oXhr.setRequestHeader('Content-Type', 'application/json')
    oXhr.responseType = 'json';

    oXhr.onload = function() {

        let status = oXhr.status;
        if (status === 200) {

            let aList = Object.entries(oXhr.response.data)
            aList.forEach(element => addLi(element[0], element[1]))

        } else {

            let aList = oXhr.response.data
            addLog(aList[0].message)

        }

    };

    oXhr.send();

}


// Обработчик - вывод подтверждения
function confirmIt(event){

    console.log('Listener confirmIt called')

    if (!confirm('Вы уверены?'))
        event.preventDefault()

}


// Функция устанавливает обработчик на класс
function addListener(className, functionName, eventType) {

    // Массив всех элементов класса className
    const aElements = document.getElementsByClassName(className)

    // Установка обработчика на все элементы класса feedback_form
    for (i = 0; i < aElements.length; i++) {
        aElements[i].addEventListener(eventType, functionName, false)
    }

    console.log(
        `Listener '${functionName.name}' to all '.${className}' added`
    )

}


// Ожидание загрузки DOM
document.addEventListener("DOMContentLoaded", function(event) {

    getList()

    addListener('remove', confirmIt, 'click')
    addListener('remove', postDelete, 'click')
    // addLog('Что-то случилось 1')
    // addLog('Что-то случилось 2')
    // addLog('Что-то случилось 3')
    // addLog('Что-то случилось 4')

    console.log('DOM loaded, js ready')

})