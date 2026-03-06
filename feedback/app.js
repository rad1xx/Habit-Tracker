let days = document.querySelectorAll('.day')
console.log(days)

days.forEach(function (day) {
    day.addEventListener('click', function () {
        day.classList.toggle('active')

        let card = day.closest('.habit-card')
        let index = card.dataset.index

        let allDays = card.querySelectorAll('.day')
        let daysState = []
        allDays.forEach(function (d) {
            daysState.push(d.classList.contains('active'))
        })

        fetch('save.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ index: index, days: daysState })
        })
    });
});

document.querySelectorAll('.habit-card h3').forEach(function(title) {
    title.addEventListener('blur', function() {
        let card = title.closest('.habit-card')
        let index = card.dataset.index
        
        fetch('save.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name: title.textContent, index: index })
        })
        .then(function(response) { return response.text() })
        .then(function(text) { console.log(text) })
    })
})

document.querySelector('.container').addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-btn')) {
        let card = event.target.closest('.habit-card')
        let index = card.dataset.index

        card.remove()

        fetch('save.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ delete: index })
        })
    }
})



let addBtn = document.querySelector('.add-btn')


addBtn.addEventListener('click', function () {



    let newcard = document.createElement('div')
    newcard.classList.add('habit-card')
    newcard.innerHTML = '<button class="delete-btn">✕</button><h3 contenteditable="true">Новая привычка</h3><div class="days"><span class="day">Пн</span><span class="day">Вт</span><span class="day">Ср</span><span class="day">Чт</span><span class="day">Пт</span><span class="day">Сб</span><span class="day">Вс</span></div>'
    document.querySelector('.container').appendChild(newcard)

    let title = newcard.querySelector('h3')

    title.addEventListener('blur', function () {
        let index = newcard.dataset.index
        fetch('save.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
           body: JSON.stringify({ name: title.textContent, index: index })
        })
            .then(function (response) { return response.text() })
            .then(function (text) { console.log(text) })

    })


    let newdays = newcard.querySelectorAll('.day')
    newdays.forEach(function (day) {
        day.addEventListener('click', function () {
            day.classList.toggle('active')


        })

    })
})


