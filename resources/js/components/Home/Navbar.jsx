import { useEffect, useState } from "react";
import Image from "../../../../public/Image/bg-images/favicon.ico";
import { Link, useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import axios from "axios";
import {
    faHouse,
    faAddressCard,
    faCircleNodes,
    faCircleLeft,
    faCircleChevronRight,
    faBusinessTime,
    faUser,
    faRightFromBracket,
    faCartPlus
} from "@fortawesome/free-solid-svg-icons";
import Cookies from "universal-cookie";
import '../../../css/app.css'


export default function Navbar() {
    const cookies = new Cookies();
    const token = cookies.get("loginToken");
    const navigate = useNavigate();
    const [cartData, setcartData] = useState([])

    const logout = async () => {
        try {
            await axios.post('api/user/logout/userLogout', null, {
                headers: {
                    'Authorization': ' Bearer ' + token
                }
            }).then((res) => {
                console.log(res.data);
                cookies.remove('loginToken');
                return navigate("/");
            }).catch((err) => {
                //   console.log(err);
            })
        } catch (error) {
            //   console.log(error);
        }

    }

    return (
        <div>
            <nav className="navbar navbar-expand-lg bg-dark fixed-top">
                <div className="container-fluid">
                    <Link
                        to="/"
                        className="fs-4 text-decoration-none fw-bold wI"
                        href="#"
                    >
                        <img src={Image} alt="" width={50} height={50} />
                        Vitra.
                    </Link>
                    <button
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        className="navbar-toggler bg-success"
                        data-bs-target="#navbarNav"
                        data-bs-toggle="collapse"
                        type="button"
                    >
                        <span className="navbar-toggler-icon" />
                    </button>
                    <div className="collapse navbar-collapse" id="navbarNav">
                        <ul className="navbar-nav">
                            <li className="nav-item ps-4 pe-4 liTab">
                                <Link
                                    to="/"
                                    aria-current="page"
                                    className="nav-link text-warning"
                                >
                                    <FontAwesomeIcon
                                        icon={faHouse}
                                        className="me-2"
                                    />
                                    Home
                                </Link>
                            </li>
                            <li className="nav-item ps-4 pe-4 liTab">
                                <Link
                                    to="/product"
                                    aria-current="page"
                                    className="nav-link text-warning"
                                >
                                    <FontAwesomeIcon
                                        icon={faBusinessTime}
                                        className="me-2"
                                    />
                                    Product
                                </Link>
                            </li>
                            <li className="nav-item ps-4 pe-4 liTab">
                                <Link
                                    to="/contact"
                                    className="nav-link text-warning"
                                    href="#"
                                >
                                    <FontAwesomeIcon
                                        icon={faAddressCard}
                                        className="me-2"
                                    />
                                    Contact
                                </Link>
                            </li>

                            {token ? (
                                <div className=" d-flex ms-lg-5 ps-lg-5">
                                    <li className="nav-item ps-4 pe-4 liTab">
                                        <button className="nav-link text-info">
                                            <Link
                                                to="/profile"
                                                className="text-decoration-none"
                                            >
                                                <FontAwesomeIcon
                                                    icon={faUser}
                                                    className="me-2"
                                                />
                                                Profile
                                            </Link>
                                        </button>
                                    </li>
                                    <li className="nav-item ps-4 pe-4 liTab">
                                        <button className="nav-link text-info" onClick={logout}>
                                            <FontAwesomeIcon
                                                icon={faRightFromBracket}
                                                className="me-2"
                                            />
                                            Logout
                                        </button>
                                    </li>
                                    <li className="nav-item ps-4 pe-4 liTab">
                                        <button className="nav-link text-info">
                                            <Link
                                                to="/cart"
                                                className="text-decoration-none"
                                            >

                                                <FontAwesomeIcon
                                                    icon={faCartPlus}
                                                    className="me-2"
                                                />
                                                Cart
                                            </Link>
                                        </button>
                                    </li>
                                </div>
                            ) : (
                                <div className=" d-flex ms-lg-5 ps-lg-5">
                                    <li className="nav-item ps-4 pe-4 liTab">
                                        <button className="nav-link text-info">
                                            <Link
                                                to="/register"
                                                className="text-decoration-none"
                                            >
                                                <FontAwesomeIcon
                                                    icon={faCircleLeft}
                                                    className="me-2"
                                                />
                                                Register
                                            </Link>
                                        </button>
                                    </li>
                                    <li className="nav-item ps-4 pe-4 liTab">
                                        <button className="nav-link text-info">
                                            <Link
                                                to="/login"
                                                className="text-decoration-none"
                                            >
                                                <FontAwesomeIcon
                                                    icon={faCircleChevronRight}
                                                    className="me-2"
                                                />
                                                Login
                                            </Link>
                                        </button>
                                    </li>
                                </div>
                            )}
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    );
}
