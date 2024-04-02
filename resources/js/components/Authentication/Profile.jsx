import { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import Cookies from "universal-cookie";
import noImg from "../../../../public/Image/bg-images/noimage.png";
import { Helmet } from "react-helmet";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import "../../../css/app.css";

export default function ProfileOverview() {
    const cookies = new Cookies();
    const navigate = useNavigate();
    const token = cookies.get("loginToken");
    const [user, setUser] = useState({});
    const [user2, setUser2] = useState({});
    const [error, setError] = useState([]);
    const [errMessage, setErrMessage] = useState("");
    const [file, setFile] = useState(null);
    const [file2, setFile2] = useState(null);
    const [visible1, setVisible1] = useState(true);
    const [visible2, setVisible2] = useState(true);
    const [visible3, setVisible3] = useState(true);
    const [oldPassword, setOldPassword] = useState("");
    const [newPassword, setNewPassword] = useState("");
    const [comfirmPassword, setComfirmPassword] = useState("");
    const [loading, setLoading] = useState(false);
    console.log(token);
    useEffect(() => {
        setLoading(true);
        axios
            .get("api/user/profile", {
                headers: {
                    Authorization: "Bearer " + token,
                },
            })
            .then((res) => {
                const userData = res.data.user;
                setUser(userData);
                setUser2(userData);
                setLoading(false);
            })
            .catch((err) => {
                console.log(err);
            });
    }, []); // Added token to the dependency array

    useEffect(() => {
        if (user && user.id) {
            axios
                .get(`api/user/profile/edit/image/retrive/${user.id}`, {
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                })
                .then((res) => {
                    setFile2(res.data.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }, [user, token]); // Added user and token to the dependency array

    const userEdit = async (e) => {
        e.preventDefault();

        const editData = {
            userName: user2.name,
            userPhone: user2.phone,
            userAddress: user2.address,
        };
        try {
            await axios
                .post("api/user/profile/edit", editData, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })
                .then((res) => {
                    if (res.status == 200) {
                        return navigate("/");
                    }
                });
        } catch (error) {
            if (error.response.status == 401) {
                setError(error.response.data.errors);
            }
        }
    };

    const handleFileChange = (e) => {
        setFile(e.target.files[0]);
    };
    const handleUpload = async () => {
        const formData = new FormData();
        formData.append("file", file);

        try {
            const response = await axios.post(
                "api/user/profile/edit/image",
                formData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        Authorization: "Bearer" + token,
                    },
                }
            );
            return navigate("/");
        } catch (error) {
            // console.error("Error uploading file:", error);
        }
    };
    const passwordChange = async (e) => {
        e.preventDefault();
        const editPassword = {
            oldPassword: oldPassword,
            newPassword: newPassword,
            comfirmPassword: comfirmPassword,
        };
        try {
            await axios
                .post("api/user/profile/edit/passwordChange", editPassword, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })
                .then((res) => {
                    if (res.status == 200) {
                        cookies.remove("loginToken");
                        return navigate("/");
                    }
                });
        } catch (error) {
            console.log(error.response.data.message);
            if (error.response.status == 401) {
                setError(error.response.data.errors);
            }
            if (error.response.status == 404) {
                setErrMessage(error.response.data.message);
            }
        }
        setOldPassword("");
        setNewPassword("");
        setComfirmPassword("");
    };
    return (
        <div>
            <Helmet>
                <title>Profile</title>
            </Helmet>

              {loading ?
                <h1 className="text-center text-danger"   style={{ marginTop: "100px" }} >
                    Loading ...
                </h1> :    <div
                className="row justify-content-center"
                style={{ marginTop: "100px" }}
            >
                <div className="col-md-3 ms-3 me-4">
                    <div className="card">
                        <div className="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            {user.image == null ? (
                                <div className="text-center mb-4">
                                    <img
                                        alt="image"
                                        className=" rounded-circle img-thumbnail"
                                        height={150}
                                        src={noImg}
                                        width={150}
                                    />
                                </div>
                            ) : (
                                <div className="text-center mb-4">
                                    <img
                                        alt="noimage"
                                        className=" rounded-circle img-thumbnail"
                                        height="150"
                                        src={`http://127.0.0.1:8000/storage/user/profile/${file2}`}
                                        width="150"
                                    />
                                </div>
                            )}
                            <h2></h2>
                            <div className="social-link mt-2">
                                <a className="me-2" href="">
                                    <i className="fa-brands fa-twitter" />
                                </a>
                                <a className="me-2" href="">
                                    <i className="fa-brands fa-facebook" />
                                </a>
                                <a className="me-2" href="">
                                    <i className="fa-brands fa-instagram" />
                                </a>
                                <a className="me-2" href="">
                                    <i className="fa-brands fa-linkedin" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="col-md-6  mt-lg-0 mt-xs-3 mt-3 mt-md-0">
                    <div className="card">
                        <div className="card-body pt-3">
                            <ul className="nav nav-tabs nav-tabs-bordered">
                                <li className="nav-item">
                                    <button
                                        className="nav-link active"
                                        data-bs-target="#profile-overview"
                                        data-bs-toggle="tab"
                                    >
                                        Overview
                                    </button>
                                </li>
                                <li className="nav-item">
                                    <button
                                        className="nav-link"
                                        data-bs-target="#profile-edit"
                                        data-bs-toggle="tab"
                                    >
                                        Edit Profile
                                    </button>
                                </li>
                                <li className="nav-item">
                                    <button
                                        className="nav-link"
                                        data-bs-target="#profile-change-password"
                                        data-bs-toggle="tab"
                                    >
                                        Change Password
                                    </button>
                                </li>
                            </ul>
                            <div className="tab-content pt-2">
                                <div
                                    className="tab-pane fade show active profile-overview"
                                    id="profile-overview"
                                >
                                    <h5 className="card-title my-3">
                                        <i className="fas fa-address-card me-2 text-success" />
                                        Profile Details
                                    </h5>
                                    <div className="row mt-3">
                                        <div className="col-lg-3 col-md-4 label ">
                                            <i className="fas fa-user-circle me-2 text-success" />
                                            Name:
                                        </div>
                                        <div className="col-lg-9 col-md-8">
                                            {user.name}
                                        </div>
                                    </div>
                                    <div className="row mt-3">
                                        <div className="col-lg-3 col-md-4 label ">
                                            <i className="far fa-address-book me-2 text-success" />
                                            Email:
                                        </div>
                                        <div className="col-lg-9 col-md-8">
                                            {user.email}
                                        </div>
                                    </div>
                                    <div className="row mt-3">
                                        <div className="col-lg-3 col-md-4 label ">
                                            <i className="fas fa-bell me-2 text-success" />
                                            Phone:
                                        </div>
                                        <div className="col-lg-9 col-md-8">
                                            {user.phone}
                                        </div>
                                    </div>
                                    <div className="row mt-3">
                                        <div className="col-lg-3 col-md-4 label ">
                                            <i className="fas fa-map-marker-alt me-2 text-success" />
                                            Address:
                                        </div>
                                        <div className="col-lg-9 col-md-8">
                                            {user.address}
                                        </div>
                                    </div>
                                </div>

                                <div
                                    className="tab-pane fade profile-edit pt-3"
                                    id="profile-edit"
                                >
                                    {user.image == null ? (
                                        <div className="text-center mb-4">
                                            <img
                                                alt="noimage"
                                                height="150"
                                                src={noImg}
                                                width="150"
                                            />
                                        </div>
                                    ) : (
                                        <div className="text-center mb-4">
                                            <img
                                                alt="image"
                                                className=" rounded-circle img-thumbnail"
                                                height="150"
                                                src={`http://127.0.0.1:8000/storage/user/profile/${file2}`}
                                                width="150"
                                            />
                                        </div>
                                    )}

                                    <div className="mb-3 row">
                                        <label className="form-label col-md-5 col-3">
                                            Image Upload:
                                        </label>
                                        <div className=" col-md-6 col-8">
                                            <input
                                                className="form-control"
                                                type="file"
                                                id="userImg"
                                                onChange={handleFileChange}
                                            />
                                        </div>
                                    </div>
                                    <div
                                        className="mb-4 btn btn-primary"
                                        onClick={handleUpload}
                                    >
                                        Upload Image
                                    </div>

                                    <form onSubmit={userEdit}>
                                        <div className="mb-3 row">
                                            <label
                                                className="form-label col-md-5   col-3"
                                                htmlFor="name"
                                            >
                                                Name:
                                            </label>
                                            <div className=" col-md-6 col-8">
                                                <input
                                                    className={
                                                        error.userName
                                                            ? "form-control is-invalid "
                                                            : "form-control"
                                                    }
                                                    value={user2.name}
                                                    onChange={(e) => {
                                                        setUser2({
                                                            ...user2,
                                                            name: e.target
                                                                .value,
                                                        });
                                                    }}
                                                    id="userName"
                                                    type="text"
                                                />
                                                {error.userName && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *{error.userName[0]}
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="mb-3 row">
                                            <label
                                                className="form-label col-md-5 col-3"
                                                htmlFor="phone"
                                            >
                                                Phone:
                                            </label>
                                            <div className=" col-md-6 col-8">
                                                <input
                                                    className={
                                                        error.userPhone
                                                            ? "form-control is-invalid "
                                                            : "form-control"
                                                    }
                                                    value={user2.phone}
                                                    onChange={(e) => {
                                                        setUser2({
                                                            ...user2,
                                                            phone: e.target
                                                                .value,
                                                        });
                                                    }}
                                                    id="userPhone"
                                                    type="text"
                                                />
                                                {error.userPhone && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *
                                                            {error.userPhone[0]}
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="mb-3 row">
                                            <label
                                                className="form-label col-md-5   col-3"
                                                htmlFor="address"
                                            >
                                                Address:
                                            </label>
                                            <div className=" col-md-6 col-8">
                                                <textarea
                                                    className={
                                                        error.userAddress
                                                            ? "form-control is-invalid "
                                                            : "form-control"
                                                    }
                                                    cols="30"
                                                    id="userAddress"
                                                    value={user2.address}
                                                    onChange={(e) => {
                                                        setUser2({
                                                            ...user2,
                                                            address:
                                                                e.target.value,
                                                        });
                                                    }}
                                                    rows="3"
                                                />
                                                {error.userAddress && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *
                                                            {
                                                                error
                                                                    .userAddress[0]
                                                            }
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className=" float-end">
                                            <input
                                                className="btn btn-success"
                                                value="Save Change"
                                                type="submit"
                                            />
                                        </div>
                                    </form>
                                </div>

                                <div
                                    className="tab-pane fade pt-3"
                                    id="profile-change-password"
                                >
                                    {errMessage && (
                                        <div
                                            class="text-center fs-5"
                                            role="alert"
                                        >
                                            <strong className="text-danger">
                                                *{errMessage}
                                            </strong>
                                        </div>
                                    )}
                                    <form onSubmit={passwordChange}>
                                        <div className=" mb-3 row">
                                            <label
                                                className="form-label col-md-5   col-3"
                                                htmlFor="oldPassword"
                                            >
                                                Old Password:
                                            </label>
                                            <div className="password-input-container col-md-6 col-8">
                                                <input
                                                    className={
                                                        error.userPassword
                                                            ? "form-control is-invalid password-input "
                                                            : "form-control password-input"
                                                    }
                                                    id="oldPassword"
                                                    type={
                                                        visible1
                                                            ? "text"
                                                            : "password"
                                                    }
                                                    value={oldPassword}
                                                    onChange={(e) => {
                                                        setOldPassword(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                                <div
                                                    className="toggle-password3"
                                                    onClick={() => {
                                                        setVisible1(!visible1);
                                                    }}
                                                >
                                                    {visible1 ? (
                                                        <FontAwesomeIcon
                                                            icon={faEye}
                                                        />
                                                    ) : (
                                                        <FontAwesomeIcon
                                                            icon={faEyeSlash}
                                                        />
                                                    )}
                                                </div>
                                                {error.oldPassword && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *
                                                            {
                                                                error
                                                                    .oldPassword[0]
                                                            }
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="mb-3 row">
                                            <label
                                                className="form-label col-md-5   col-3"
                                                htmlFor="newPassword"
                                            >
                                                New Password:
                                            </label>
                                            <div className="password-input-container col-md-6 col-8">
                                                <input
                                                    className={
                                                        error.userPassword
                                                            ? "form-control is-invalid password-input "
                                                            : "form-control password-input"
                                                    }
                                                    id="newPassword"
                                                    type={
                                                        visible2
                                                            ? "text"
                                                            : "password"
                                                    }
                                                    value={newPassword}
                                                    onChange={(e) => {
                                                        setNewPassword(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                                <div
                                                    className="toggle-password3"
                                                    onClick={() => {
                                                        setVisible2(!visible2);
                                                    }}
                                                >
                                                    {visible2 ? (
                                                        <FontAwesomeIcon
                                                            icon={faEye}
                                                        />
                                                    ) : (
                                                        <FontAwesomeIcon
                                                            icon={faEyeSlash}
                                                        />
                                                    )}
                                                </div>
                                                {error.newPassword && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *
                                                            {
                                                                error
                                                                    .newPassword[0]
                                                            }
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="mb-3 row">
                                            <label
                                                className="form-label col-md-5   col-3"
                                                htmlFor="comfirmPassword"
                                            >
                                                Comfirm Password:
                                            </label>
                                            <div className="password-input-container col-md-6 col-8">
                                                <input
                                                    className={
                                                        error.userPassword
                                                            ? "form-control is-invalid password-input "
                                                            : "form-control password-input"
                                                    }
                                                    id="comfirmPassword"
                                                    type={
                                                        visible3
                                                            ? "text"
                                                            : "password"
                                                    }
                                                    value={comfirmPassword}
                                                    onChange={(e) => {
                                                        setComfirmPassword(
                                                            e.target.value
                                                        );
                                                    }}
                                                />
                                                <div
                                                    className="toggle-password3"
                                                    onClick={() => {
                                                        setVisible3(!visible3);
                                                    }}
                                                >
                                                    {visible3 ? (
                                                        <FontAwesomeIcon
                                                            icon={faEye}
                                                        />
                                                    ) : (
                                                        <FontAwesomeIcon
                                                            icon={faEyeSlash}
                                                        />
                                                    )}
                                                </div>
                                                {error.comfirmPassword && (
                                                    <div>
                                                        <span className="text-danger">
                                                            *
                                                            {
                                                                error
                                                                    .comfirmPassword[0]
                                                            }
                                                        </span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className=" float-end">
                                            <input
                                                className="btn btn-warning"
                                                type="submit"
                                                value="Password Change"
                                            />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script
                    dangerouslySetInnerHTML={{
                        __html: '                //jquery                $(document).ready(function() {                    $(".toggle-password").click(function() {                        var passwordInput = $($(this).siblings(".password-input"));                        var icon = $(this);                        if (passwordInput.attr("type") == "password") {                            passwordInput.attr("type", "text");                            icon.removeClass("fa-eye-slash").addClass("fa-eye");                        } else {                            passwordInput.attr("type", "password");                            icon.removeClass("fa-eye").addClass("fa-eye-slash");                        }                    });                })            ',
                    }}
                />
            </div>
            }



        </div>
    );
}
