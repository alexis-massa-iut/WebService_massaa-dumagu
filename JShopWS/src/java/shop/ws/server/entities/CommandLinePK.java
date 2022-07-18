/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package shop.ws.server.entities;

import java.io.Serializable;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Embeddable;

/**
 *
 * @author alexi
 */
@Embeddable
public class CommandLinePK implements Serializable {

    @Basic(optional = false)
    @Column(name = "command_id")
    private int commandId;
    @Basic(optional = false)
    @Column(name = "product_id")
    private int productId;

    public CommandLinePK() {
    }

    public CommandLinePK(int commandId, int productId) {
        this.commandId = commandId;
        this.productId = productId;
    }

    public int getCommandId() {
        return commandId;
    }

    public void setCommandId(int commandId) {
        this.commandId = commandId;
    }

    public int getProductId() {
        return productId;
    }

    public void setProductId(int productId) {
        this.productId = productId;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (int) commandId;
        hash += (int) productId;
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof CommandLinePK)) {
            return false;
        }
        CommandLinePK other = (CommandLinePK) object;
        if (this.commandId != other.commandId) {
            return false;
        }
        if (this.productId != other.productId) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "shop.ws.server.entities.CommandLinePK[ commandId=" + commandId + ", productId=" + productId + " ]";
    }
    
}
