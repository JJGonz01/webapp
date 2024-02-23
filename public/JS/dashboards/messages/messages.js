const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function createMessage(name, title, subtitle, button_one, button_two, type, image){
    const request = {
        name: name,
        title: title,
        subtitle: subtitle,
        button_one: button_one,
        button_two: button_two,
        type: type,
        image: image,
    };
    console.log(request);
    fetch('/messages/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(request)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(response => {
        console.log('Response from server:', response);
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });
}

function getMessages(primary){
    
    fetch('/messages/index', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(request => {
        console.log('Response from server:', request);
        openMessagesPopUp(primary, request)
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });

    
}