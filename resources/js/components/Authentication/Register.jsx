import axios from "axios";
import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import "../../../css/app.css";
import { Helmet } from "react-helmet";
import Cookies from "universal-cookie";

export default function Register() {

    const cookies = new Cookies();
    const navigate = useNavigate();

    const [userName, setUserName] = useState("");
    const [userEmail, setUserEmail] = useState("");
    const [userPassword, setUserPassword] = useState("");
    const [userPhone, setUserPhone] = useState("");
    const [userAddress, setUserAddress] = useState("");
    const [role, setRole] = useState("user");
    const [error, setError] = useState([]);
    const [success, setSuccess] = useState("");
    const [visible, setVisible] = useState(true);

    const submitRegister = async (e) => {
        e.preventDefault();

        const userData = {
            userName: userName,
            userEmail: userEmail,
            userPassword: userPassword,
            userPhone: userPhone,
            userAddress: userAddress,
            role: "user",
        }
        console.log(userData);
        try {
            await axios
                .post("http://127.0.0.1:8000/api/user/register/userRegister", userData)
                .then((response) => {
                    console.log(response.data.access_token);
                    setUserName("");
                    setUserEmail("");
                    setUserPassword("");
                    setUserPhone("");
                    setUserAddress("");
                  const token =  response.data.access_token;
                    // Check response data
                    cookies.set("userToken", token, { path: '/', maxAge: 86400 });
                    navigate('/')
                })
                .catch((error) => {
                    console.error('Error:', error);
                    if (error.response.status == 401) {
                        setError(error.response.data.errors);
                    } else {
                        setError("Network error occurred"); // Set a default error message
                    }
                });
        } catch (error) {
            console.log(error.response.data.errors);
        }
    };
    return (
        <div>
            <Helmet>
                <title>Register</title>
            </Helmet>
            <form
                className="row g-3 w-75 mx-auto p-4"
                style={{
                    marginTop: "50px",
                    backgroundColor: "rgba(255, 255, 255, 0.096)",
                }}
                onSubmit={submitRegister}
            >
                <h2 className="text-primary text-center">Register Form</h2>
                {success && (
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <strong>{success}</strong>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                )}
                <div className="col-md-6">
                    <label
                        className="form-label text-primary fs-5"
                        htmlFor="userName"
                    >
                        Name
                    </label>
                    <input
                        className={
                            error.userName
                                ? "form-control is-invalid "
                                : "form-control"
                        }
                        id="userName"
                        type="text"
                        value={userName}
                        onChange={(e) => {
                            setUserName(e.target.value);
                        }}
                    />
                    {error.userName && (
                        <div>
                            <span className="text-danger">
                                *{error.userName[0]}
                            </span>
                        </div>
                    )}
                </div>
                <div className="col-md-6">
                    <label
                        className="form-label text-primary fs-5"
                        htmlFor="userEmail"
                    >
                        Email
                    </label>
                    <input
                        className={
                            error.userEmail
                                ? "form-control is-invalid "
                                : "form-control"
                        }
                        id="userEmail"
                        type="text"
                        value={userEmail}
                        onChange={(e) => {
                            setUserEmail(e.target.value);
                        }}
                    />
                    {error.userEmail && (
                        <div>
                            <span className="text-danger">
                                *{error.userEmail[0]}
                            </span>
                        </div>
                    )}
                </div>
                <div className="col-md-6 password-input-container">
                    <label
                        className="form-label text-primary fs-5"
                        htmlFor="userPassword"
                    >
                        Password
                    </label>
                    <input
                        className={
                            error.userPassword
                                ? "form-control is-invalid password-input "
                                : "form-control password-input"
                        }
                        id="userPassword"
                        type={visible ? "text" : "password"}
                        value={userPassword}
                        onChange={(e) => {
                            setUserPassword(e.target.value);
                        }}
                    />
                    <div
                        className="toggle-password"
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
                    {error.userPassword && (
                        <div>
                            <span className="text-danger">
                                *{error.userPassword[0]}
                            </span>
                        </div>
                    )}
                </div>
                <div className="col-md-6">
                    <label
                        className="form-label text-primary fs-5"
                        htmlFor="userPhone"
                    >
                        Phone
                    </label>
                    <input
                        className={
                            error.userPhone
                                ? "form-control is-invalid "
                                : "form-control"
                        }
                        id="userPhone"
                        type="text"
                        value={userPhone}
                        onChange={(e) => {
                            setUserPhone(e.target.value);
                        }}
                    />
                    {error.userPhone && (
                        <div>
                            <span className="text-danger">
                                *{error.userPhone[0]}
                            </span>
                        </div>
                    )}
                </div>
                <div className="col-md-6 mx-auto">
                    <label
                        className="form-label text-primary fs-5"
                        htmlFor="userAddress"
                    >
                        Address
                    </label>
                    <input
                        className={
                            error.userAddress
                                ? "form-control is-invalid "
                                : "form-control"
                        }
                        id="userAddress"
                        type="text"
                        value={userAddress}
                        onChange={(e) => {
                            setUserAddress(e.target.value);
                        }}
                    />
                    {error.userAddress && (
                        <div>
                            <span className="text-danger">
                                *{error.userAddress[0]}
                            </span>
                        </div>
                    )}
                </div>
                <input
                    className="form-control"
                    id="role"
                    value={role}
                    type="hidden"
                />
                <div className="col-12">
                    <div className="form-check">
                        <input className="form-check-input" type="checkbox" />
                        <label
                            className="form-check-label text-primary"
                            htmlFor="invalidCheck2"
                        >
                            Remember Me
                        </label>
                    </div>
                </div>
                <div className="col-12">
                    <Link to="/login">You have already account?</Link>
                </div>
                <div className="col-12">
                    <button className="btn btn-primary" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    );
}
