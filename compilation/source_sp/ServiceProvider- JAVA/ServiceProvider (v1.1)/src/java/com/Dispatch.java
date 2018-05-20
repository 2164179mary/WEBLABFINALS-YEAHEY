package com;


import java.sql.Blob;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jcadriano
 */
public class Dispatch {
    private String customerName;
    private String servicename;
    private String price;
    private Blob image;
    private String requested;
    private String dispatch;
    private String customerID;
    private String serviceID;

    public Dispatch(String customerName, String servicename, String price, Blob image, String requested, String dispatch, String customerID, String serviceID) {
        this.customerName = customerName;
        this.servicename = servicename;
        this.price = price;
        this.image = image;
        this.requested = requested;
        this.dispatch = dispatch;
        this.customerID = customerID;
        this.serviceID = serviceID;
    }

    public String getCustomerName() {
        return customerName;
    }

    public void setCustomerName(String customerName) {
        this.customerName = customerName;
    }

    public String getServicename() {
        return servicename;
    }

    public void setServicename(String servicename) {
        this.servicename = servicename;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public Blob getImage() {
        return image;
    }

    public void setImage(Blob image) {
        this.image = image;
    }

    public String getRequested() {
        return requested;
    }

    public void setRequested(String requested) {
        this.requested = requested;
    }

    public String getDispatch() {
        return dispatch;
    }

    public void setDispatch(String dispatch) {
        this.dispatch = dispatch;
    }

    public String getCustomerID() {
        return customerID;
    }

    public void setCustomerID(String customerID) {
        this.customerID = customerID;
    }

    public String getServiceID() {
        return serviceID;
    }

    public void setServiceID(String serviceID) {
        this.serviceID = serviceID;
    }

}
