import React, { useState, useEffect } from 'react'
import { Helmet } from "react-helmet"
import axios from "axios";

export default function contact() {

    const [firstName, setFirstName] = useState("");
    const [surName, setSurName] = useState("");
    const [emailAddress, setEmailAddress] = useState("");
    const [orderNumber, setOrderNumber] = useState("");
    const [phone, setPhone] = useState("");
    const [streetAdddress, setStreetAdddress] = useState("");
    const [postcode, setPostcode] = useState("");
    const [city, setCity] = useState("");
    const [country, setCountry] = useState("");
    const [message, setMessage] = useState("");
    const [isChecked, setIsChecked] = useState(false);
    const [isDisabled, setIsDisabled] = useState(false);
    const [error, setError] = useState([]);
    const [success, setSuccess] = useState('');

    const checkOrNot = () => {
        setIsChecked(!isChecked);
        setIsDisabled(!isDisabled);
    };

    const submitConMess = async (e) => {
        e.preventDefault();

        const userContactMessage = {
            firstName: firstName,
            surName: surName,
            emailAddress: emailAddress,
            orderNumber: orderNumber,
            phone: phone,
            streetAdddress: streetAdddress,
            postcode: postcode,
            city: city,
            country: country,
            message: message
        }
        // console.log(userContactMessage);
        try {
            await axios
                .post("api/user/contact/message", userContactMessage)
                .then((res)=> {
                     console.log(res.data);
                     if (res.status === 200) {
                        setSuccess(res.data.message)
                        setFirstName('')
                        setSurName('')
                        setEmailAddress('')
                        setOrderNumber('')
                        setPhone('')
                        setStreetAdddress('')
                        setPostcode('')
                        setCity('')
                        setCountry('')
                        setMessage('')
                     }
                     setError('')
                })
                .catch((err)=> {
                    if (err.response.status === 422) {
                        setError(err.response.data.errors)
                     }
                     setSuccess('')
                })

        } catch (error) {
            console.log('errors:' + error);
        }
    }
    return (
        <div>
            <Helmet>
                <title>Contact</title>
            </Helmet>
            <div className='w-75 mx-auto  bg-light p-5 ' style={{ marginTop: '10px' }}>
                <h1 className='text-center mb-4 text-warning mt-3'>Contact Form</h1>

                {success && <div className='text-center mt-4 mb-4 text-success fs-5'>{success}</div>}
                <form
                    className="row g-3 needs-validation" onSubmit={submitConMess}
                >
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="firstName"
                        >
                            First Name *(Required)
                        </label>
                        <input
                            className="form-control"
                            value={firstName}
                            id="firstName"
                            type="text"
                            onChange={(e) => setFirstName(e.target.value)}
                            placeholder='First Name *'
                        />
                           {error.firstName && (
                        <div>
                            <span className="text-danger">
                                *{error.firstName[0]}
                            </span>
                        </div>
                    )}
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="surName"
                        >
                            Sur Name *(Required)
                        </label>
                        <input
                            className="form-control"
                            value={surName}
                            id="surName"
                            type="text"
                            onChange={(e) => setSurName(e.target.value)}
                            placeholder='Sur Name *'
                        />
                         {error.surName && (
                        <div>
                            <span className="text-danger">
                                *{error.surName[0]}
                            </span>
                        </div>
                    )}
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="emailAddress"
                        >
                            Email Address *(Required)
                        </label>
                        <input
                            className="form-control"
                            value={emailAddress}
                            id="emailAddress"
                            type="text"
                            onChange={(e) => setEmailAddress(e.target.value)}
                            placeholder='Email Address *'
                        />
                          {error.emailAddress && (
                        <div>
                            <span className="text-danger">
                                *{error.emailAddress[0]}
                            </span>
                        </div>
                          )}
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="phone"
                        >
                            Phone Number
                        </label>
                        <input
                            className="form-control"
                            value={phone}
                            id="phone"
                            type="text"
                            onChange={(e) => setPhone(e.target.value)}
                            placeholder='Phone Number'
                        />
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="orderNumber"
                        >
                            Order Number
                        </label>
                        <input
                            className="form-control"
                            value={orderNumber}
                            id="orderNumber"
                            onChange={(e) => setOrderNumber(e.target.value)}
                            placeholder='Order Number'
                            type="text"
                        />
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="streetAdddress"
                        >
                            Street Address
                        </label>
                        <input
                            className="form-control"
                            value={streetAdddress}
                            id="streetAdddress"
                            type="text"
                            onChange={(e) => setStreetAdddress(e.target.value)}
                            placeholder='Street Address'
                        />
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="postcode"
                        >
                            Postcode
                        </label>
                        <input
                            className="form-control"
                            value={postcode}
                            id="postcode"
                            type="text"
                            onChange={(e) => setPostcode(e.target.value)}
                            placeholder='Postcode'
                        />
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="city"
                        >
                            City
                        </label>
                        <input
                            className="form-control"
                            value={city}
                            id="city"
                            type="text"
                            onChange={(e) => setCity(e.target.value)}
                            placeholder='City'
                        />
                    </div>
                    <div className="col-md-4">
                        <label
                            className="form-label"
                            htmlFor="country"
                        >
                            Country *(Required)
                        </label>
                        <input
                            className="form-control"
                            value={country}
                            id="country"
                            type="text"
                            onChange={(e) => setCountry(e.target.value)}
                            placeholder='Country *'
                        />
                          {error.country && (
                        <div>
                            <span className="text-danger">
                                *{error.country[0]}
                            </span>
                        </div>
                          )}
                    </div>
                    <div className="col-md-12">
                        <label
                            className="form-label"
                            htmlFor="message"
                        >
                            Your Message
                        </label>
                  <div>
                  <textarea id="message" cols="30" rows="10" onChange={(e) => setMessage(e.target.value)}
                            placeholder='Your Message' value={message}>

                        </textarea>
                  </div>
                    </div>
                    <div className="col-12">
                        <div className="form-check">
                            <input
                                className="form-check-input"
                                id="invalidCheck"
                                type="checkbox"
                                checked={isChecked}
                                onChange={checkOrNot}
                            />
                            <label
                                className="form-check-label"
                                htmlFor="invalidCheck"
                            >
                                Agree to terms and conditions
                            </label>
                        </div>
                    </div>
                    <div className="col-12">
                        <button
                           className={
                            isDisabled
                                ? "btn btn-primary"
                                : "btn btn-primary disabled "
                        }
                            type="submit"
                        >
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    )
}
