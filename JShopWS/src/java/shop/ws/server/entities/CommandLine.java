/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package shop.ws.server.entities;

import java.io.Serializable;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.EmbeddedId;
import javax.persistence.Entity;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author alexismassa
 */
@Entity
@Table(name = "command_line")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "CommandLine.findAll", query = "SELECT c FROM CommandLine c"),
    @NamedQuery(name = "CommandLine.findByCommandId", query = "SELECT c FROM CommandLine c WHERE c.commandLinePK.commandId = :commandId"),
    @NamedQuery(name = "CommandLine.findByProductId", query = "SELECT c FROM CommandLine c WHERE c.commandLinePK.productId = :productId"),
    @NamedQuery(name = "CommandLine.findByAmount", query = "SELECT c FROM CommandLine c WHERE c.amount = :amount"),
    @NamedQuery(name = "CommandLine.findByPrice", query = "SELECT c FROM CommandLine c WHERE c.price = :price")})
public class CommandLine implements Serializable {

    private static final long serialVersionUID = 1L;
    @EmbeddedId
    protected CommandLinePK commandLinePK;
    @Basic(optional = false)
    @Column(name = "amount")
    private int amount;
    @Basic(optional = false)
    @Column(name = "price")
    private double price;
    @JoinColumn(name = "command_id", referencedColumnName = "id", insertable = false, updatable = false)
    @ManyToOne(optional = false)
    private Command command;
    @JoinColumn(name = "product_id", referencedColumnName = "id", insertable = false, updatable = false)
    @ManyToOne(optional = false)
    private Product product;

    public CommandLine() {
    }

    public CommandLine(CommandLinePK commandLinePK) {
        this.commandLinePK = commandLinePK;
    }

    public CommandLine(CommandLinePK commandLinePK, int amount, double price) {
        this.commandLinePK = commandLinePK;
        this.amount = amount;
        this.price = price;
    }

    public CommandLine(int commandId, int productId) {
        this.commandLinePK = new CommandLinePK(commandId, productId);
    }

    public CommandLinePK getCommandLinePK() {
        return commandLinePK;
    }

    public void setCommandLinePK(CommandLinePK commandLinePK) {
        this.commandLinePK = commandLinePK;
    }

    public int getAmount() {
        return amount;
    }

    public void setAmount(int amount) {
        this.amount = amount;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public Command getCommand() {
        return command;
    }

    public void setCommand(Command command) {
        this.command = command;
    }

    public Product getProduct() {
        return product;
    }

    public void setProduct(Product product) {
        this.product = product;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (commandLinePK != null ? commandLinePK.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof CommandLine)) {
            return false;
        }
        CommandLine other = (CommandLine) object;
        if ((this.commandLinePK == null && other.commandLinePK != null) || (this.commandLinePK != null && !this.commandLinePK.equals(other.commandLinePK))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "shop.ws.server.entities.CommandLine[ commandLinePK=" + commandLinePK + " ]";
    }
    
}
