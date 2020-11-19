<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | React.js | Axios Example</title>
    <script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <!-- Load Babel Compiler -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="/test/dist/app.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<div class="product-image">
    <img src="/test/src/pack.png" alt="pack" />
</div>
<div class="center-text">
    <p class="yellow-text">הפכנו את כדור המגנזיום לגרגירים</p>
    <p class="w-big-text">כדי שתיקחו את זה בקלות</p>
    <div class="bottom-text">
        <p>גרגירי מגנזיום להקלה על התכווצות שרירים,
        קל לנטילה, נמס בפה, בטעם לימון עדין.</p>
    </div>
    <div class="icons-wrapper">
        <img src="/test/src/icon1.png" alt="icon-01" />
        <img src="/test/src/icon2.png" alt="icon-01" />
        <img src="/test/src/icon3.png" alt="icon-01" />
        <img src="/test/src/icon4.png" alt="icon-01" />
    </div>
</div>
<div class="form-wrapper">
<img src="/test/src/logo.png" alt="logo" class="logo">
    <h2>לקבלת דוגמית חינם</h2>
    <p>מלאו את הפרטים</p>
    <div><span>*</span>שדה חובה</div>
    <div id='root'></div>
</div>
<footer></footer>
<script  type="text/babel">

class App extends React.Component {
  state = {
    contacts: []
  }
//   componentDidMount() {
//     const url = '/api/contacts.php'
//     axios.get(url).then(response => response.data)
//     .then((data) => {
//       this.setState({ contacts: data })
//       console.log(this.state.contacts)
//      })
//   }
  render() {
    return (
        <React.Fragment>
        <ContactForm />
        </React.Fragment>
    );
  }
}

class ContactForm extends React.Component {
    // const mailsent = false;
    state = {
        fname: '',
        lastname: '',
        phonenumer: '',
        email: '',
        street: '',
        homenum: '',
        city: '',
        postalcode: '',
        // mailSent: '',
    }

    handleFormSubmit( event ) {
        event.preventDefault();
        console.log(this.state);
        // this.setState({[name]: value}, 
        //         () => { this.validateField(name, value) });
    }

    validateField(fieldName, value) {
        console.log(fieldName);
        console.log(value);
        if( fieldName == 'fname' && value.length <= 1 ){
            this.setState({ namenotvalid: true });
        }else if( fieldName == 'fname' && value.length > 1 ){
            this.setState({ namenotvalid: false });
        }
        if( fieldName == 'lastname' && value.length <= 1 ){
            this.setState({ lnamenotvalid: true });
        }else if( fieldName == 'lastname' && value.length > 1 ){
            this.setState({ lnamenotvalid: false });
        }
}

setStatus = e => {
    // let this;
    console.log(this);
    // this.setState({ phonenumer: e.target.value }
}

handleChange(evt) {
//   console.log("new value", evt.target.name);
  this.setState({ [evt.target.name]: evt.target.value });
  this.validateField(evt.target.name, evt.target.value);
}

    handleFormSubmit = e => {
        e.preventDefault();
        const API_PATH = 'http://briday.local/test/mail_api.php';
        const mailsent = false;
        axios({
            method: 'post',
            url: `${API_PATH}`,
            headers: { 'content-type': 'application/json' },
            data: this.state
        })
            .then(result => {
                // console.log(result.data.error);
                console.log(result.data.sent);
            this.setState({
                mailSent: result.data.sent,
                message: result.data.message
            });
            console.log(mailSent);
            console.log(message);
            })
            .catch(error => this.setState({ error: error.message }));
    };

    render(){
        return (
            <form action="#" className={ this.state.mailSent ? "form-send" : "" }>
            <div>{this.state.error}</div>
                <div class="form-row mb-4">
                    <div class="col">
                        <input type="text" id="fname" name="fname" placeholder="* שם פרטי" className={ this.state.namenotvalid ? "form-control notvalid" : "form-control" }
                            value={this.state.fname}
                            onChange={e => this.handleChange(e)}
                        />
                    </div>
                    <div class="col">
                        <input type=" text" id="lname" name="lastname" placeholder="* שם משפחה" className={ this.state.lnamenotvalid ? "form-control notvalid" : "form-control" }
                            value={this.state.lastname}
                            onChange={e => this.handleChange(e)}
                        />
                    </div>
                </div>
                <div class="form-row mb-4">
                    <input type=" text" id="phonenumer" name="phonenumer" placeholder="*נייד" class="form-control"
                        value={this.state.phonenumer}
                        onChange={e => this.setState({ phonenumer: e.target.value })}
                    />
                </div>
                <div class="form-row mb-4">
                    <input type="email" id="email" name="email" placeholder="* מייל" class="form-control"
                        value={this.state.email}
                        onChange={e => this.setState({ email: e.target.value })}
                    />
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-md-8">
                        <input type=" text" id="street" name="street" placeholder="* רחוב" class="form-control"
                            value={this.state.street}
                            onChange={e => this.setState({ street: e.target.value })}
                        />
                    </div>
                    <div class="form-group col-md-4">
                        <input type=" text" id="homenum" name="homenum" placeholder="* מס' בית" class="form-control"
                            value={this.state.homenum}
                            onChange={e => this.setState({ homenum: e.target.value })}
                        />
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-md-8">
                        <input type=" text" id="city" name="city" placeholder="עיר" class="form-control"
                        value={this.state.city}
                        onChange={e => this.setState({ city: e.target.value })}
                        />
                    </div>
                    <div class="form-group col-md-4">
                        <input type=" text" id="postalcode" name="postalcode" placeholder="מיקוד" class="form-control"
                        value={this.state.postalcode}
                        onChange={e => this.setState({ postalcode: e.target.value })}
                        />
                    </div>
                </div>
                <input type="submit" onClick={ e => this.handleFormSubmit(e) } value="להרשמה וקבלת דוגמית <" />
                <div>
                    <div>{this.state.message}</div>
                </div>
            </form >
        );
    }
}

ReactDOM.render(<App />, document.getElementById('root'));
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>