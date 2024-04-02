import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import "../../../css/app.css";
import Cookies from "universal-cookie";
import { Helmet } from "react-helmet";

export default function Login() {

    const cookies = new Cookies();
    const navigate = useNavigate();

    const [isChecked, setIsChecked] = useState(false);
    const [isDisabled, setIsDisabled] = useState(false);
    const [visible, setVisible] = useState(true);
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [errors, setErrors] = useState([]);
    const [errMessage, setErrMessage] = useState("");
    const [defToken, setDefToken] = useState("");
    const [isToken, setIsToken] = useState(false);

    const checkOrNot = () => {
        setIsChecked(!isChecked);
        setIsDisabled(!isDisabled);
    };

    const submitLogin = async (e) => {
        e.preventDefault();
        const loginData = {
            email: email,
            password: password,
        }
        console.log(loginData);
        try {
            await axios
                .post("api/user/login/userLogin", loginData)
                .then((response) => {
                    console.log(response.data.access_token);
                        const token = response.data.access_token;
                         cookies.set("loginToken", token,{ path: '/', maxAge: 86400});
                        setIsToken(true);
                        setEmail("");
                        setPassword("");
                        if (!isToken) {
                            return navigate("/");
                        } else {
                            return navigate("/login");
                        }
                })
                .catch((error) => {
                     console.log(error);
                     if (error.response.status == 422) {
                        setErrors(error.response.data.errors);
                        setErrMessage('');
                    }
                    if (error.response.status == 401) {
                        setErrMessage(error.response.data.message);
                        setErrors('');
                    }
                });
        } catch (error) {
             console.log(error);
        }
    };

    return (
        <div>
            <Helmet>
                <title>Login</title>
            </Helmet>
            <form
                className="row g-3 w-50 mx-auto p-4"
                style={{
                    marginTop: "50px",
                    backgroundColor: "rgba(255, 255, 255, 0.096)",
                }}
                onSubmit={submitLogin}
            >
                <h2 className="text-primary text-center">Login Form</h2>
                {errMessage && (
                    <div className="text-center fs-5" role="alert">
                        <strong className="text-danger">*{errMessage}</strong>
                    </div>
                )}
                <div className="col-md-6">
                    <label
                        className="form-label text-primary"
                        htmlFor="validationServer01"
                    >
                        Email
                    </label>
                    <input
                        className={
                            errors.email
                                ? "form-control is-invalid "
                                : "form-control"
                        }
                        id="email"
                        type="text"
                        value={email}
                        onChange={(e) => {
                            setEmail(e.target.value);
                        }}
                    />
                    {errors.email && (
                        <div>
                            <span className="text-danger">
                                *{errors.email[0]}
                            </span>
                        </div>
                    )}
                </div>
                <div className="col-md-6 password-input-container">
                    <label
                        className="form-label text-primary"
                        htmlFor="validationServer02"
                    >
                        Password
                    </label>
                    <input
                        className={
                            errors.password
                                ? "form-control is-invalid password-input "
                                : "form-control password-input"
                        }
                        id="password"
                        type={visible ? "text" : "password"}
                        value={password}
                        onChange={(e) => {
                            setPassword(e.target.value);
                        }}
                    />
                    {errors.password && (
                        <div>
                            <span className="text-danger">
                                *{errors.password[0]}
                            </span>
                        </div>
                    )}
                    <div
                        className="toggle-password2"
                        onClick={() => {
                            setVisible(!visible);
                        }}
                    >
                        {visible ? (
                            <FontAwesomeIcon icon={faEye} />
                        ) : (
                            <FontAwesomeIcon icon={faEyeSlash} />
                        )}
                    </div>
                </div>

                <div className="col-12">
                    <div className="form-check">
                        <input
                            aria-describedby="invalidCheck3Feedback"
                            className="form-check-input"
                            id="invalidCheck3"
                            type="checkbox"
                            checked={isChecked}
                            onChange={checkOrNot}
                        />
                        <label
                            className="form-label text-primary"
                            htmlFor="invalidCheck3"
                        >
                            Agree to terms and conditions
                        </label>
                    </div>
                </div>
                <div className="col-12">
                    <Link to="/register">You don't have an account yet?</Link>
                </div>
                <div className="col-12">
                    <button
                        className={
                            isDisabled
                                ? "btn btn-primary"
                                : "btn btn-primary disabled "
                        }
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    );
}
