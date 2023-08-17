<style>
  body {
    font-family: Arial, sans-serif;
    background-color: rgb(250, 250, 250);
  }

  h1 {
    text-align: center;
    margin-top: 70px;
  }

  .container {
    width: 80%;
    margin-left: 10%;
    margin: 0 auto;
    padding: 2em 3em;
    background-color: #ffffff;
    border-radius: 0.7em;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="password"] {
    width: 95%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #ccc;
    outline: none;
  }

  button {
    display: block;
    width: 100%;
    padding: 0.75em;
    margin-top: 2em;
    border-radius: 0.5em;
    border: none;
    background-color: #1B9C85;
    color: #ffffff;
    font-size: 16px;
    transition: all 0.3s;
    cursor: pointer;
  }

  button:hover {
    background-color: #106052
  }

  .error-message {
    margin-top: 1.5em;
    color: #FF0060;
		padding: 0.75em;
		text-align: center;
		border-radius: 0.3em;
		background: #ffe7f0
  }

  .outerbox {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    width: 100%;
    height: 100%;
  }

  .outerbox>div {
    flex: 1;
  }

  .leftside {
    background: white;
    border-right: 1px solid rgb(240, 240, 240);
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    justify-content: center;
  }

  .leftside>img {
    width: 40em;
  }

  .leftside>div {
    display: flex;
    align-items: center;
    gap: 1em;
  }

  .titles>h2 {
    font-size: 1.6em;
    margin-bottom: 0.1em;
  }

  .titles>p {
    opacity: 0.6;
    margin-top: 0.8em;
  }

  .rightside {
    padding: 2em;
  }

  .form-group {
    margin: 1.2em 0;
  }

  .form-group>input {
    padding: 0.75em 1.2em;
    border: none;
    width: 100%;
    font-size: 1em;
    outline: 1px solid rgb(230, 230, 230);
    background: rgb(250, 250, 250);
    border-radius: 0.5em;
    margin-top: 0.3em;
  }

  .form-group>label {
    font-weight: 400;
  }

  .container>div>h2 {
    font-size: 1.8em;
    color: #1B9C85;
  }

  .container>div>p {
    margin-top: 0.6em;
    font-size: 0.9em;
    opacity: 0.5;
    margin-bottom: 1.8em;
  }
</style>
<div id="apps"></div>
<script type="text/babel">
  const { useState } = React;
  const App = () => {
    const [errorMessage, setErrorMessage] = useState(false);
    const [correctCredentials, setCorrectCredentials] = useState({ username: '', password: '' });
    const handleLogin = e => {
      e.preventDefault();
      let formData = new FormData(document.getElementById('formlogin'));
      formData = Object.fromEntries(formData.entries());
      // validate data user
      $.ajax({
        url: `<?=base_url()?>index.php/Users/validasi_user`,
        data: formData,
        method: 'POST',
        success: data => {
          let datalength = JSON.parse(data).length
          if(datalength > 0){
            window.location.href = "index.php/Dashboard";
          } else {
            setErrorMessage(true)
            setTimeout(() => {
              setErrorMessage(false);
            }, 5000);
          }
        },
      })
    };
    return (
      <div className="outerbox">
        <div className="leftside">
          <div>
            <img src="./assets/icon.png" alt="logounsia" width="60" />
            <div className="titles">
              <h2>SI Cetak Ijazah</h2>
              <p>Poltektrans SDP Palembang</p>
            </div>
          </div>
          <img alt="illustration" src="./assets/login.png" />
        </div>
        <div className="rightside">
          <div className="container">
            <div>
              <h2>Login Admin Ijazah</h2>
              <p>Please login with authorized account.</p>
            </div>
            <form method="POST" onSubmit={handleLogin} id="formlogin">
              <div className="form-group">
                <label htmlFor="username">Username</label>
                <input
                  type="text"
                  id="username"
                  name="username"
                  placeholder="e.g. Admin"
                  required
                />
              </div>
              <div className="form-group">
                <label htmlFor="password">Password</label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="type password ..."
                  required
                />
              </div>
              {
                errorMessage ? (
                  <div className="error-message">
                    <i className="fas fa-times-circle"></i> Sorry, Username or password is incorrect!
                  </div>
                ) : null
              }
              <div className="form-group">
                <button type="submit">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    );
  };
  
  const root = document.querySelector('#apps');
  const el = ReactDOM.createRoot(root);
  el.render(<App />);
</script>
</html>
