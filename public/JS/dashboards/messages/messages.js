const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function createMessage(name, title, subtitle, button_one, button_two, type, image){
    const request = {
        name: 'John',
        title: 'John',
        subtitle: 'John',
        button_one: 'John',
        button_two: 'John',
        type: 1,
        image: 1,
    };
    
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

function getMessages(){
    
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
        callGetIndexedMessage(request);
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });

    
}