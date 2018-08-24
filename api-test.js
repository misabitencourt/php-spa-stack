const request = require('supertest');
const host = 'http://localhost:8080';


/*
    Login test
*/
(async () => {
    try {
        await request(host)
            .post('/api/login/')
            .send({email: 'misabitencourt@gmail.com', password: 'admin123'})
            .set('Accept', 'application/json')
            .expect('Content-Type', /json/)
            .expect(200);
    } catch (e) {
        console.error(e);    
    }
    
    try {
        await request(host)
                    .post('/api/login/')
                    .send({email: 'misabitencourt@gmail.com', password: '123456'})
                    .set('Accept', 'application/json')
                    .expect('Content-Type', /json/)
                    .expect(401);
    } catch (e) {
        console.error(e);    
    }

})().then(() => console.log('Tests finished!!'));



/*
    TODO mais testes
*/