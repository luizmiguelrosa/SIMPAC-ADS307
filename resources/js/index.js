var symposium_end_form = document.getElementById("symposium.end")

symposium_end_form.addEventListener("submit", function(event) {
    event.preventDefault()
    let edition = prompt("Digite a edição desejada para iniciar")
    let password = prompt("Digite a sua senha de administrador")
    
    fetch(symposium_end_form.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ edition: edition, password: password})
    })
})
