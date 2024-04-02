import React from 'react'

export default function CategoryRelPro({category, records, proDetail}) {

  return (
    <div>
    <h3 className="text-primary text-center mb-5">
                        Related Products
                    </h3>
                    <h3 className="text-warning text-center mb-5">
                        {category.name}
                    </h3>
                    <div className="d-lg-flex ps-md-5 text-center">
                        {records.map((pro) => (
                            <div
                                className="cards m-4 mx-auto"
                                style={{ width: "18rem", cursor: 'pointer'}}
                                key={pro.id}
                            >
                                <img
                                    src={`http://127.0.0.1:8000/storage/product/${pro.image}`}
                                    className="card-img-top"
                                    alt="..."
                                    onClick={()=>proDetail(pro.id)}
                                />
                                <div className="card-body bg-white">
                                    <h5 className="card-title text-primary">{pro.name}</h5>
                                    <h5 className="card-title text-primary">{pro.price}</h5>
                                </div>

                            </div>
                        ))}
                    </div>
    </div>
  )
}
